<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Page;
use App\Models\Section;
use App\Models\SectionItem;
use Illuminate\Http\UploadedFile;

echo "--- Testing HTTP File Upload to Controller ---\n";

// Get Super Admin user
$user = User::first();
if (!$user) {
    echo "No user found in database!\n";
    exit;
}
echo "User: " . $user->email . "\n";

// Get Home Page and Hero Section
$page = Page::where('slug', 'home')->first();
if (!$page) {
    echo "Home page not found!\n";
    exit;
}

$heroSection = $page->sections()->where('type', 'hero_carousel')->orWhere('type', 'hero_banner')->first();
if (!$heroSection) {
    echo "Hero section not found!\n";
    exit;
}
echo "Section ID: " . $heroSection->id . " | Type: " . $heroSection->type . "\n";

// Create temp test image (3MB to test upload size limits)
$tempFilePath = tempnam(sys_get_temp_dir(), 'hero_test_');
$imageContent = base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
// Pad file to 3MB
$imageContent .= str_repeat('0', 3 * 1024 * 1024);
file_put_contents($tempFilePath, $imageContent);

echo "Created test image size: " . filesize($tempFilePath) . " bytes (" . round(filesize($tempFilePath)/1024/1024, 2) . " MB)\n";

$uploadedFile = new UploadedFile(
    $tempFilePath,
    'test_3mb_hero.jpg',
    'image/jpeg',
    null,
    true
);

// Act as user and make POST request with _method=PUT
$response = $this->actingAs($user)->post("/admin/sections/{$heroSection->id}", [
    '_method' => 'PUT',
    'heading' => $heroSection->heading ?? 'Hero Heading',
    'subheading' => $heroSection->subheading ?? 'Hero Subheading',
    'body' => $heroSection->body ?? 'Hero Body',
    'is_active' => '1',
    'order' => '1',
    'hero_media_file' => $uploadedFile,
]);

echo "Response status: " . $response->status() . "\n";
if ($response->exception) {
    echo "Exception: " . $response->exception->getMessage() . "\n";
}
if (session('errors')) {
    echo "Session Errors:\n";
    print_r(session('errors')->all());
}

@unlink($tempFilePath);
