<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use App\Models\SectionItem;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Home Page
        $home = Page::create([
            'name' => 'Home',
            'slug' => 'home',
            'meta_title' => 'Mercury Bangladesh - Your Better Choice for Shipping Needs',
            'meta_description' => 'Mercury Bangladesh is a premium logistics, freight, and shipping company offering dependable global logistics operations.',
        ]);

        // Home Section 1: Hero Carousel
        $hero = Section::create([
            'page_id' => $home->id,
            'type' => 'hero_carousel',
            'heading' => 'Global Logistics, Simplified',
            'subheading' => 'MB · 01 — HERO',
            'body' => 'Mercury is your better choice for any shipping need.',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $hero->id,
            'title' => 'Reliable Sea Freight Solutions',
            'description' => 'Connecting ports globally with exact shipping schedules and cargo manifests.',
            'value' => '/images/hero-sea.jpg',
            'link' => '/services',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $hero->id,
            'title' => 'Next-Day Air Cargo Dispatch',
            'description' => 'Urgent shipments delivered on time with optimized custom clearance routes.',
            'value' => '/images/hero-air.jpg',
            'link' => '/services',
            'order' => 2,
        ]);

        // Home Section 2: About Us
        Section::create([
            'page_id' => $home->id,
            'type' => 'about_us',
            'heading' => 'Precision in Transit, Certainty in Delivery',
            'subheading' => 'MB · 02 — ABOUT US',
            'body' => 'Mercury Bangladesh (Pvt.) Ltd. represents the premium standard in modern corporate freight forwarding. We oversee and execute end-to-end logistics with absolute compliance, utilizing structured carrier networks and proprietary tracking systems to ensure client peace of mind.',
            'order' => 2,
        ]);

        // Home Section 3: Vision & Mission Tiles
        $visionMission = Section::create([
            'page_id' => $home->id,
            'type' => 'vision_mission',
            'heading' => 'Our Core Directives',
            'subheading' => 'MB · 03 — VALUES',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $visionMission->id,
            'title' => 'Our Vision',
            'description' => 'To be the most dependable and precise gateway for global trade in Bangladesh, setting benchmarks in operational excellence.',
            'icon' => 'Eye',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $visionMission->id,
            'title' => 'Our Mission',
            'description' => 'To manage complex supply chains through transparent communication, rigorous document compliance, and strict schedule adherence.',
            'icon' => 'Compass',
            'order' => 2,
        ]);

        // Home Section 4: Why Choose Us
        $whyUs = Section::create([
            'page_id' => $home->id,
            'type' => 'why_choose_us',
            'heading' => 'Engineered for Performance',
            'subheading' => 'ROUTE / WHY MERCURY',
            'body' => 'Logistics is not just moving cargo; it is keeping promises. We build long-term relationships through dependable operations.',
            'order' => 4,
        ]);

        SectionItem::create([
            'section_id' => $whyUs->id,
            'title' => 'Customs Compliance Expertise',
            'description' => 'Errors in documentation delay freight. Our dedicated brokerage ensures zero-deficit entry.',
            'icon' => 'FileCheck',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $whyUs->id,
            'title' => 'Global Network Integration',
            'description' => 'Direct partnerships with leading ocean liners and air carriers secure container space allocations.',
            'icon' => 'Network',
            'order' => 2,
        ]);

        // Home Section 5: Stats Bar (Shared/Global)
        $stats = Section::create([
            'page_id' => $home->id,
            'type' => 'stats',
            'heading' => 'Mercury by the Numbers',
            'subheading' => 'DATA · PERFORMANCE INDICATORS',
            'order' => 5,
        ]);

        SectionItem::create([
            'section_id' => $stats->id,
            'title' => 'Years of Experience',
            'value' => '15',
            'subtitle' => '+',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $stats->id,
            'title' => 'Countries Covered',
            'value' => '120',
            'subtitle' => '+',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $stats->id,
            'title' => 'Shipments Delivered',
            'value' => '50',
            'subtitle' => 'k+',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $stats->id,
            'title' => 'SLA Compliance Rate',
            'value' => '99',
            'subtitle' => '%',
            'order' => 4,
        ]);

        // Home Section 6: Get in Touch
        Section::create([
            'page_id' => $home->id,
            'type' => 'get_in_touch',
            'heading' => 'Need Cargo Transport Solutions?',
            'subheading' => 'ROUTE · COMMUNICATE',
            'body' => 'Get in touch with our operations desk to coordinate your next shipment manifest.',
            'order' => 6,
        ]);


        // 2. About Page
        $about = Page::create([
            'name' => 'About Us',
            'slug' => 'about',
            'meta_title' => 'About Mercury Bangladesh - Corporate History & Values',
            'meta_description' => 'Learn about the founding story, foundation principles, and milestones of Mercury Bangladesh.',
        ]);

        Section::create([
            'page_id' => $about->id,
            'type' => 'hero_banner',
            'heading' => 'The Story Behind Our Precise Operations',
            'subheading' => 'MB · 01 — FOUNDATION',
            'body' => 'Forging shipping reliability through meticulous planning and corporate structure.',
            'order' => 1,
        ]);

        Section::create([
            'page_id' => $about->id,
            'type' => 'our_story',
            'heading' => 'A Decade of Unbroken Shipping Links',
            'subheading' => 'MB · 02 — DETAILED NARRATIVE',
            'body' => 'Founded to bridge the complex requirements of manufacturers in Bangladesh with international destinations, Mercury Bangladesh has grown into a highly trusted logistics operation. We do not compromise on document compliance or schedule timelines.',
            'order' => 2,
        ]);

        $foundation = Section::create([
            'page_id' => $about->id,
            'type' => 'foundation',
            'heading' => 'Our Core Foundations',
            'subheading' => 'MB · 03 — PRINCIPLES',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $foundation->id,
            'title' => 'Absolute Integrity',
            'description' => 'Every invoice, container manifest, and transit report is verified and exact.',
            'icon' => 'ShieldCheck',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $foundation->id,
            'title' => 'Scheduled Predictability',
            'description' => 'We select lanes and carriers based on historic on-time arrival metrics.',
            'icon' => 'Clock',
            'order' => 2,
        ]);

        $history = Section::create([
            'page_id' => $about->id,
            'type' => 'history',
            'heading' => 'Chronological Milestones',
            'subheading' => 'MB · 04 — TIMELINE',
            'order' => 4,
        ]);

        SectionItem::create([
            'section_id' => $history->id,
            'title' => 'Company Incorporated',
            'subtitle' => '2011',
            'description' => 'Mercury Bangladesh starts freight operations focusing on garment exports to Europe.',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $history->id,
            'title' => 'Customs Brokerage Licence',
            'subtitle' => '2015',
            'description' => 'Acquired in-house clearance licence at Dhaka Airport and Chittagong Port.',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $history->id,
            'title' => 'Warehouse Expansion',
            'subtitle' => '2021',
            'description' => 'Opened a modern 50,000 sq ft consolidation hub near Chittagong.',
            'order' => 3,
        ]);

        Section::create([
            'page_id' => $about->id,
            'type' => 'closing_cta',
            'heading' => 'Ready to Route Your Freight?',
            'subheading' => 'MB · 05 — CALL TO ACTION',
            'body' => 'Submit your logistics challenge and watch our coordinators draft a secure manifest.',
            'order' => 5,
        ]);


        // 3. Services Page
        $servicesPage = Page::create([
            'name' => 'Services',
            'slug' => 'services',
            'meta_title' => 'Logistics Services - Sea, Air & Warehousing | Mercury Bangladesh',
            'meta_description' => 'Discover our range of logistics services including ocean freight, air cargo, warehousing, and customs clearance.',
        ]);

        Section::create([
            'page_id' => $servicesPage->id,
            'type' => 'hero_banner',
            'heading' => 'Comprehensive Logistics Solutions',
            'subheading' => 'MB · 01 — CAPABILITIES',
            'body' => 'Engineered routes, secured containers, and professional customs brokers.',
            'order' => 1,
        ]);

        $freightMoves = Section::create([
            'page_id' => $servicesPage->id,
            'type' => 'freight_moves',
            'heading' => 'Modes of Transport',
            'subheading' => 'MB · 02 — MODAL TRANSIT',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $freightMoves->id,
            'title' => 'Ocean Freight',
            'description' => 'FCL and LCL shipping via premier alliances.',
            'icon' => 'Ship',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $freightMoves->id,
            'title' => 'Air Freight',
            'description' => 'Direct and deferred global flights for cargo.',
            'icon' => 'Plane',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $freightMoves->id,
            'title' => 'Road Transport',
            'description' => 'Inland trucking fleet linking ports to factories.',
            'icon' => 'Truck',
            'order' => 3,
        ]);


        // 4. Contact Page
        $contact = Page::create([
            'name' => 'Contact',
            'slug' => 'contact',
            'meta_title' => 'Contact Operations - Mercury Bangladesh',
            'meta_description' => 'Contact the Mercury Bangladesh office in Dhaka for bookings, manifests, and customs quotes.',
        ]);

        Section::create([
            'page_id' => $contact->id,
            'type' => 'hero_banner',
            'heading' => 'Establish Connection with our Operations Desk',
            'subheading' => 'MB · 01 — ENQUIRIES',
            'body' => 'Get in touch for rate sheets, carrier schedules, and customs clearance advice.',
            'order' => 1,
        ]);

        Section::create([
            'page_id' => $contact->id,
            'type' => 'intro',
            'heading' => 'Dhaka Headquarters & Port Offices',
            'subheading' => 'MB · 02 — LOCATIONS',
            'body' => 'We manage offices adjacent to cargo terminals to ensure fast file processing and cargo release.',
            'order' => 2,
        ]);
    }
}
