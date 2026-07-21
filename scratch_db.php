<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$contactPage = App\Models\Page::where('slug', 'contact')->first();
if ($contactPage) {
    echo "PAGE: " . $contactPage->name . "\n";
    foreach ($contactPage->sections as $sec) {
        echo "SECTION: id=" . $sec->id . ", type=" . $sec->type . ", order=" . $sec->order . ", active=" . ($sec->is_active ? 'yes' : 'no') . ", heading=" . $sec->heading . "\n";
    }
} else {
    echo "No contact page found\n";
}

