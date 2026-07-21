<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$consoleKernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$consoleKernel->bootstrap();
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use App\Models\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

echo "--- Testing Direct Request Dispatch with File Upload & Session CSRF ---\n";

$user = User::first();
Auth::login($user);

$page = Page::where('slug', 'home')->first();
$heroSection = $page->sections()->where('type', 'hero_carousel')->orWhere('type', 'hero_banner')->first();

echo "User logged in: " . Auth::user()->email . "\n";
echo "Testing section ID: " . $heroSection->id . " (" . $heroSection->type . ")\n";

// Start session
$session = $app->make('session')->driver();
$session->start();
$session->put('_token', 'test_csrf_token_123');

// 1. Create a 3MB image to test upload size (which fails if PHP limit is 2M)
$largeTemp = tempnam(sys_get_temp_dir(), 'hero_3mb_');
file_put_contents($largeTemp, base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7') . str_repeat('A', 3 * 1024 * 1024));

$largeFile = new UploadedFile(
    $largeTemp,
    'test_3mb.jpg',
    'image/jpeg',
    UPLOAD_ERR_OK,
    true
);

$req = Request::create(
    "/admin/sections/{$heroSection->id}",
    'POST',
    [
        '_token' => 'test_csrf_token_123',
        '_method' => 'PUT',
        'heading' => $heroSection->heading ?? 'Hero Heading',
        'subheading' => $heroSection->subheading ?? 'Hero Subheading',
        'body' => $heroSection->body ?? 'Hero Body',
        'is_active' => '1',
        'order' => '1',
    ],
    [],
    [
        'hero_media_file' => $largeFile
    ],
    ['HTTP_ACCEPT' => 'application/json']
);

$req->setLaravelSession($session);

$response = $kernel->handle($req);

echo "3MB file upload HTTP status: " . $response->getStatusCode() . "\n";
if ($session->has('errors')) {
    echo "Session errors:\n";
    print_r($session->get('errors')->all());
}
if ($session->has('success')) {
    echo "Session success: " . $session->get('success') . "\n";
}


@unlink($largeTemp);

