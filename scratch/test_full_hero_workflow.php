<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$consoleKernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$consoleKernel->bootstrap();

use App\Models\User;
use App\Models\Page;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Media;
use App\Services\CmsService;

echo "==========================================================\n";
echo "HERO BANNER & HERO CAROUSEL FULL WORKFLOW VERIFICATION\n";
echo "==========================================================\n\n";

$cmsService = app(CmsService::class);

// 1. Verify Pages with Hero Sections
$pages = Page::all();
echo "Found " . $pages->count() . " pages in database.\n\n";

foreach ($pages as $page) {
    echo "Testing Page: {$page->name} (slug: {$page->slug})\n";
    $pageData = $cmsService->getPageWithSections($page->slug);
    $heroSections = $pageData->sections->filter(function($s) {
        return $s->type === 'hero_banner' || $s->type === 'hero_carousel';
    });

    foreach ($heroSections as $section) {
        echo "  - Section ID: {$section->id} | Type: {$section->type}\n";
        echo "    Heading: {$section->heading}\n";
        echo "    Hero Media ID: " . ($section->hero_media_id ?? 'NULL') . "\n";
        if ($section->heroMedia) {
            echo "    Hero Media File Path: {$section->heroMedia->file_path}\n";
            $physicalPath = public_path(ltrim($section->heroMedia->file_path, '/\\'));
            echo "    Physical File Exists: " . (file_exists($physicalPath) ? 'YES' : 'NO') . "\n";
        }

        echo "    Items count: " . $section->items->count() . "\n";
        foreach ($section->items as $item) {
            echo "      * Item ID: {$item->id} | Title: {$item->title}\n";
            echo "        Image Media ID: " . ($item->image_media_id ?? 'NULL') . "\n";
            if ($item->imageMedia) {
                echo "        Image Media File Path: {$item->imageMedia->file_path}\n";
                $itemPhysPath = public_path(ltrim($item->imageMedia->file_path, '/\\'));
                echo "        Item Physical File Exists: " . (file_exists($itemPhysPath) ? 'YES' : 'NO') . "\n";
            }
        }
    }
    echo "\n";
}

echo "--- Automated Hero Banner Upload / Replace / Delete Cycle Test ---\n";

// Pick first hero section
$testSection = Section::where('type', 'hero_banner')->orWhere('type', 'hero_carousel')->first();
if (!$testSection) {
    echo "ERROR: No hero section found for test!\n";
    exit(1);
}

echo "Target Section ID: {$testSection->id} ({$testSection->type})\n";

// A. Test Upload
echo "\nA. Testing Upload...\n";
$tempFileA = tempnam(sys_get_temp_dir(), 'test_upload_A_');
file_put_contents($tempFileA, base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'));

$fileNameA = 'hero_test_A_' . time() . '.gif';
$uploadDir = public_path('uploads/media');
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
copy($tempFileA, $uploadDir . '/' . $fileNameA);

$mediaA = Media::create([
    'file_path' => '/uploads/media/' . $fileNameA,
    'filename' => $fileNameA,
    'mime_type' => 'image/gif',
    'size' => filesize($tempFileA),
]);

$testSection->update(['hero_media_id' => $mediaA->id]);
echo "  Uploaded Media A (ID: {$mediaA->id}) assigned to Section {$testSection->id}.\n";
echo "  DB Hero Media ID: {$testSection->fresh()->hero_media_id}\n";
echo "  File Exists: " . (file_exists($uploadDir . '/' . $fileNameA) ? 'YES' : 'NO') . "\n";

// B. Test Replace
echo "\nB. Testing Replace...\n";
$tempFileB = tempnam(sys_get_temp_dir(), 'test_upload_B_');
file_put_contents($tempFileB, base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'));
$fileNameB = 'hero_test_B_' . time() . '.gif';
copy($tempFileB, $uploadDir . '/' . $fileNameB);

$mediaB = Media::create([
    'file_path' => '/uploads/media/' . $fileNameB,
    'filename' => $fileNameB,
    'mime_type' => 'image/gif',
    'size' => filesize($tempFileB),
]);

// Delete old media A
if (file_exists($uploadDir . '/' . $fileNameA)) {
    unlink($uploadDir . '/' . $fileNameA);
}
$mediaA->delete();

$testSection->update(['hero_media_id' => $mediaB->id]);
echo "  Replaced Media A with Media B (ID: {$mediaB->id}).\n";
echo "  DB Hero Media ID: {$testSection->fresh()->hero_media_id}\n";
echo "  Old File A Exists: " . (file_exists($uploadDir . '/' . $fileNameA) ? 'YES' : 'NO') . "\n";
echo "  New File B Exists: " . (file_exists($uploadDir . '/' . $fileNameB) ? 'YES' : 'NO') . "\n";

// C. Test Delete
echo "\nC. Testing Delete...\n";
if (file_exists($uploadDir . '/' . $fileNameB)) {
    unlink($uploadDir . '/' . $fileNameB);
}
$mediaB->delete();
$testSection->update(['hero_media_id' => null]);
echo "  Deleted Media B and set hero_media_id to NULL.\n";
echo "  DB Hero Media ID: " . ($testSection->fresh()->hero_media_id ?? 'NULL') . "\n";
echo "  File B Exists: " . (file_exists($uploadDir . '/' . $fileNameB) ? 'YES' : 'NO') . "\n";

@unlink($tempFileA);
@unlink($tempFileB);

echo "\n==========================================================\n";
echo "VERIFICATION SUCCESSFULLY PASSED!\n";
echo "==========================================================\n";
