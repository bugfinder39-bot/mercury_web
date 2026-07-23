<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Setting;

// Seed Coming Soon Settings
Setting::firstOrCreate(
    ['key' => 'coming_soon_enabled'],
    ['value' => 'false', 'group' => 'general']
);

Setting::firstOrCreate(
    ['key' => 'coming_soon_target'],
    ['value' => 'entire_website', 'group' => 'general']
);

// Seed Coming Soon Page
$comingSoonPage = Page::where('slug', 'coming-soon')->first();

if (!$comingSoonPage) {
    $comingSoonPage = Page::create([
        'name' => 'Coming Soon',
        'slug' => 'coming-soon',
        'meta_title' => 'Coming Soon | Mercury Bangladesh (Pvt.) Ltd.',
        'meta_description' => 'Our next-generation corporate logistics and maritime operations portal is under active development. Check back soon for seamless supply chain tracking.',
    ]);

    // Hero Section
    $csHero = Section::create([
        'page_id' => $comingSoonPage->id,
        'type' => 'coming_soon_hero',
        'heading' => 'WE ARE LAUNCHING SOMETHING EXTRAORDINARY',
        'subheading' => 'COMING SOON · MERCURY BANGLADESH',
        'body' => 'Our next-generation maritime logistics portal and global tracking suite are currently under active development. We are engineering a faster, more transparent supply chain experience for all your shipping requirements.',
        'cta_primary_btn_text' => 'Contact Operations',
        'cta_primary_btn_url' => '/contact',
        'cta_secondary_btn_text' => 'Return to Main Site',
        'cta_secondary_btn_url' => '/',
        'order' => 1,
        'is_active' => true,
    ]);

    // Work In Progress Section
    $csWip = Section::create([
        'page_id' => $comingSoonPage->id,
        'type' => 'coming_soon_wip',
        'heading' => 'Engineering Modern Maritime Logistics',
        'subheading' => 'MB · 02 — WORK IN PROGRESS',
        'body' => 'We are fine-tuning our carrier integrations, document verification engines, and real-time container tracking to provide an uncompromised corporate logistics standard.',
        'progress_label' => '85% Completed — System Architecture & Live Verification',
        'expected_launch_text' => 'Estimated Launch: Q4 2026',
        'order' => 2,
        'is_active' => true,
    ]);

    // What To Expect Section
    $csFeatures = Section::create([
        'page_id' => $comingSoonPage->id,
        'type' => 'coming_soon_features',
        'heading' => 'What To Expect',
        'subheading' => 'MB · 03 — UPCOMING FEATURES',
        'body' => 'Here is a preview of the advanced corporate shipping tools currently being integrated into our digital platform.',
        'order' => 3,
        'is_active' => true,
    ]);

    SectionItem::create([
        'section_id' => $csFeatures->id,
        'title' => 'Real-Time Cargo Telemetry',
        'subtitle' => 'Maritime & Air Dispatch',
        'description' => 'Instant container status updates, port milestone notifications, and automated ETA forecasting.',
        'icon' => 'Anchor',
        'order' => 1,
        'is_active' => true,
    ]);

    SectionItem::create([
        'section_id' => $csFeatures->id,
        'title' => 'Automated Customs Manifests',
        'subtitle' => 'Compliance & Filing',
        'description' => 'Streamlined document verification and digital customs clearance for reduced port dwell times.',
        'icon' => 'ShieldCheck',
        'order' => 2,
        'is_active' => true,
    ]);

    SectionItem::create([
        'section_id' => $csFeatures->id,
        'title' => 'Unified Freight Dashboard',
        'subtitle' => 'Client Operations',
        'description' => 'Single-pane control panel for quote management, shipment history, and invoice dispatches.',
        'icon' => 'Globe',
        'order' => 3,
        'is_active' => true,
    ]);

    SectionItem::create([
        'section_id' => $csFeatures->id,
        'title' => 'Dedicated Account Concierge',
        'subtitle' => '24/7 Operations',
        'description' => 'Direct communication channels with experienced logistics officers for urgent cargo requirements.',
        'icon' => 'Clock',
        'order' => 4,
        'is_active' => true,
    ]);

    // Stay Connected / CTA Section
    $csCta = Section::create([
        'page_id' => $comingSoonPage->id,
        'type' => 'coming_soon_cta',
        'heading' => 'Need Immediate Shipping Support?',
        'subheading' => 'MB · 04 — STAY CONNECTED',
        'body' => 'Our physical offices, sea freight desks, and customs clearing teams remain fully operational. Reach out directly for immediate shipment assistance.',
        'cta_primary_btn_text' => 'Contact Operations Desk',
        'cta_primary_btn_url' => '/contact',
        'cta_secondary_btn_text' => 'Return to Main Site',
        'cta_secondary_btn_url' => '/',
        'order' => 4,
        'is_active' => true,
    ]);

    echo "Coming Soon Page successfully created with ID: " . $comingSoonPage->id . "\n";
} else {
    echo "Coming Soon Page already exists with ID: " . $comingSoonPage->id . "\n";
}
