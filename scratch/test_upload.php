<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Section;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

echo "--- Testing PHP Upload Limits ---\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";

echo "\n--- Testing Public Uploads Directory ---\n";
$uploadDir = public_path('uploads/media');
echo "Upload dir path: " . $uploadDir . "\n";
echo "Exists: " . (file_exists($uploadDir) ? 'YES' : 'NO') . "\n";
echo "Writable: " . (is_writable($uploadDir) ? 'YES' : 'NO') . "\n";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
    echo "Created upload dir!\n";
}

echo "\n--- Testing Fake File Upload Validation ---\n";
// Create a fake image file for testing
$tempFile = tempnam(sys_get_temp_dir(), 'test_img_');
// Write minimal 1x1 GIF header
file_put_contents($tempFile, base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'));

$uploadedFile = new UploadedFile(
    $tempFile,
    'test_hero.gif',
    'image/gif',
    null,
    true // test mode
);

$validator = Validator::make([
    'hero_media_file' => $uploadedFile
], [
    'hero_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120'
]);

if ($validator->fails()) {
    echo "Validation FAILED:\n";
    print_r($validator->errors()->all());
} else {
    echo "Validation PASSED!\n";
}

echo "\n--- Testing File Move & Media DB Creation ---\n";
try {
    $size = $uploadedFile->getSize();
    $mime = $uploadedFile->getClientMimeType();
    $extension = $uploadedFile->getClientOriginalExtension() ?: 'gif';
    $fileName = 'test_hero_' . time() . '_' . uniqid() . '.' . $extension;

    $uploadedFile->move($uploadDir, $fileName);
    echo "Moved file to: " . $uploadDir . '/' . $fileName . "\n";

    $media = Media::create([
        'file_path' => '/uploads/media/' . $fileName,
        'filename' => $fileName,
        'mime_type' => $mime,
        'size' => $size,
    ]);
    echo "Created Media record ID: " . $media->id . "\n";

    // Clean up test record
    $media->delete();
    @unlink($uploadDir . '/' . $fileName);
    echo "Cleanup complete!\n";
} catch (\Throwable $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}

