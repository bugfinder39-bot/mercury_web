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
        $aboutUsSec = Section::create([
            'page_id' => $home->id,
            'type' => 'about_us',
            'heading' => 'Precision in Transit, Certainty in Delivery',
            'subheading' => 'MB · 02 — ABOUT US',
            'body' => 'Mercury Bangladesh (Pvt.) Ltd. represents the premium standard in modern corporate freight forwarding. We oversee and execute end-to-end logistics with absolute compliance, utilizing structured carrier networks and proprietary tracking systems to ensure client peace of mind.',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $aboutUsSec->id,
            'title' => 'About Image',
            'value' => '/images/about-home.jpg',
            'order' => 1,
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

        // Home Section 5: Featured Services
        Section::create([
            'page_id' => $home->id,
            'type' => 'featured_services',
            'heading' => 'Specialized Transport and Logistics Services',
            'subheading' => 'MB · 05 — CAPABILITIES',
            'body' => 'We provide specialized and customized shipping solutions to support global commerce.',
            'order' => 5,
        ]);

        // Home Section 6: Statistics
        $stats = Section::create([
            'page_id' => $home->id,
            'type' => 'stats',
            'heading' => 'Mercury by the Numbers',
            'subheading' => 'DATA · PERFORMANCE INDICATORS',
            'order' => 6,
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

        // Home Section 7: CEO Message
        Section::create([
            'page_id' => $home->id,
            'type' => 'ceo_message',
            'heading' => 'Message From Our Chief Executive',
            'subheading' => 'CEO NARRATIVE',
            'ceo_rich_text' => '<p>Mercury Bangladesh represents the premium standard in modern corporate freight forwarding. We oversee and execute end-to-end logistics with absolute compliance, utilizing structured carrier networks and proprietary tracking systems to ensure client peace of mind.</p><p>We believe in building long-term relationships through dependable operations and transparency.</p>',
            'ceo_name' => 'Mahbubur Rahman',
            'ceo_designation' => 'Managing Director & CEO',
            'ceo_cta_button_text' => 'Contact Our Office',
            'ceo_cta_button_url' => '/contact',
            'order' => 7,
        ]);

        // Home Section 8: Why Businesses Trust Mercury
        $trust = Section::create([
            'page_id' => $home->id,
            'type' => 'businesses_trust',
            'heading' => 'Why Businesses Trust Mercury',
            'subheading' => 'OUR PILLARS',
            'body' => 'We operate with integrity, schedule predictability, and absolute transparency.',
            'order' => 8,
        ]);

        SectionItem::create([
            'section_id' => $trust->id,
            'title' => 'Absolute Compliance',
            'description' => 'We verify every custom manifest, certificate of origin, and tax declaration to prevent port delays.',
            'icon' => 'ShieldAlert',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $trust->id,
            'title' => 'Guaranteed Container Allocations',
            'description' => 'Direct carrier contracts ensure your space is allocated even during peak shipping seasons.',
            'icon' => 'Layers',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $trust->id,
            'title' => '24/7 Digital Tracking Desk',
            'description' => 'Receive real-time progress reports and coordinate directly with our shipment managers.',
            'icon' => 'Clock',
            'order' => 3,
        ]);

        // Home Section 9: Image + Text Showcase
        $showcase = Section::create([
            'page_id' => $home->id,
            'type' => 'image_text_showcase',
            'heading' => 'Global Reach & Freight Connectivity',
            'subheading' => 'CONNECTING THE WORLD',
            'body' => 'Mercury is your better choice for any shipping need. We align air, ocean, and road freight routes to minimize transit periods.',
            'order' => 9,
        ]);

        SectionItem::create([
            'section_id' => $showcase->id,
            'title' => 'Image',
            'value' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $showcase->id,
            'title' => 'Position',
            'value' => 'left',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $showcase->id,
            'title' => 'Customs Clearance Brokerage',
            'description' => 'Licensed brokers handling customs documentation, duty calculations, and cargo releases at Dhaka and Chittagong.',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $showcase->id,
            'title' => 'Warehousing & Cargo Consolidation',
            'description' => 'Modern consolidation hubs ensuring safe cargo handling and distribution logistics.',
            'order' => 4,
        ]);

        SectionItem::create([
            'section_id' => $showcase->id,
            'title' => 'CTA',
            'description' => 'Explore Freight Modes',
            'link' => '/services',
            'order' => 5,
        ]);

        // Home Section 10: Image Gallery
        $gallery = Section::create([
            'page_id' => $home->id,
            'type' => 'image_gallery',
            'heading' => 'Modern Logistics & Fleet Gallery',
            'subheading' => 'VISUAL OPERATIONS',
            'body' => 'A showcase of our global logistics operations, freight carriers, warehousing, and secure transit.',
            'order' => 10,
        ]);

        SectionItem::create([
            'section_id' => $gallery->id,
            'title' => 'Chittagong Port Terminal',
            'description' => 'Loading container vessels for European destinations.',
            'value' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=800&auto=format&fit=crop&q=80',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $gallery->id,
            'title' => 'Air Cargo Dispatch',
            'description' => 'Urgent cargo dispatch at Hazrat Shahjalal International Airport.',
            'value' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&auto=format&fit=crop&q=80',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $gallery->id,
            'title' => 'Consolidation Warehouse',
            'description' => '50,000 sq ft consolidation hub near Chittagong.',
            'value' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $gallery->id,
            'title' => 'Inland Trucking Fleet',
            'description' => 'Linking factories to port consolidation terminals.',
            'value' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&auto=format&fit=crop&q=80',
            'order' => 4,
        ]);

        SectionItem::create([
            'section_id' => $gallery->id,
            'title' => 'Logistics Planning Desk',
            'description' => 'Real-time supply chain monitoring and manifest routing.',
            'value' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&auto=format&fit=crop&q=80',
            'order' => 5,
        ]);

        // Home Section 11: Operational Excellence
        $excellence = Section::create([
            'page_id' => $home->id,
            'type' => 'operational_excellence',
            'heading' => 'Secured Supply Chain Execution',
            'subheading' => 'OPERATIONAL EXCELLENCE',
            'body' => 'We ensure high SLAs through rigorous schedule verification and compliant transit paths.',
            'order' => 11,
        ]);

        SectionItem::create([
            'section_id' => $excellence->id,
            'title' => 'Image',
            'value' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=800&auto=format&fit=crop&q=80',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $excellence->id,
            'title' => 'Position',
            'value' => 'right',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $excellence->id,
            'title' => 'Scheduled Shipping Lines',
            'description' => 'Lining cargo with leading carrier alliances to secure predictable departure and arrival dates.',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $excellence->id,
            'title' => 'Strict SLA Adherence',
            'description' => '99% SLA compliance rate across import/export transit routes.',
            'order' => 4,
        ]);

        // Home Section 12: Company Highlights
        $highlights = Section::create([
            'page_id' => $home->id,
            'type' => 'company_highlights',
            'heading' => 'Mercury by the Numbers',
            'subheading' => 'DATA · PERFORMANCE INDICATORS',
            'body' => 'A decade of logistics excellence backed by verifiable operational scale.',
            'order' => 12,
        ]);

        SectionItem::create([
            'section_id' => $highlights->id,
            'title' => 'Years of Experience',
            'value' => '15',
            'subtitle' => '+',
            'icon' => 'Clock',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $highlights->id,
            'title' => 'Countries Covered',
            'value' => '120',
            'subtitle' => '+',
            'icon' => 'Globe',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $highlights->id,
            'title' => 'Shipments Delivered',
            'value' => '50',
            'subtitle' => 'k+',
            'icon' => 'Truck',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $highlights->id,
            'title' => 'Customer Satisfaction',
            'value' => '99',
            'subtitle' => '%',
            'icon' => 'Smile',
            'order' => 4,
        ]);

        // Home Section 13: Working Process
        $process = Section::create([
            'page_id' => $home->id,
            'type' => 'working_process',
            'heading' => 'Our Working Process',
            'subheading' => 'HOW WE WORK',
            'body' => 'From query to final cargo delivery, our logistics pipeline is engineered for transparent execution.',
            'order' => 13,
        ]);

        SectionItem::create([
            'section_id' => $process->id,
            'title' => 'Consultation',
            'description' => 'Assessing your route, freight weight, and custom requirements.',
            'icon' => 'HelpCircle',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $process->id,
            'title' => 'Logistics Planning',
            'description' => 'Selecting optimal air or sea carriers to secure spacing.',
            'icon' => 'Calendar',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $process->id,
            'title' => 'Document Clearance',
            'description' => 'Acquiring and verifying all manifest documents for zero-delay exit.',
            'icon' => 'FileText',
            'order' => 3,
        ]);

        SectionItem::create([
            'section_id' => $process->id,
            'title' => 'Transportation',
            'description' => 'Cargo loading and real-time tracking through active transit lanes.',
            'icon' => 'Navigation',
            'order' => 4,
        ]);

        SectionItem::create([
            'section_id' => $process->id,
            'title' => 'Secure Delivery',
            'description' => 'Final release and handoff at destination port or client warehouse.',
            'icon' => 'CheckCircle2',
            'order' => 5,
        ]);

        // Home Section 14: Partners
        Section::create([
            'page_id' => $home->id,
            'type' => 'partners',
            'heading' => 'Global Carrier Partnerships',
            'subheading' => 'PARTNERS',
            'order' => 14,
        ]);

        // Home Section 15: Testimonials
        $testimonialsSec = Section::create([
            'page_id' => $home->id,
            'type' => 'testimonials',
            'heading' => 'What Our Clients Say',
            'subheading' => 'TESTIMONIALS',
            'body' => 'We build long-term relationships through dependable operations. Hear from our global business partners.',
            'order' => 15,
        ]);

        SectionItem::create([
            'section_id' => $testimonialsSec->id,
            'title' => 'Sarah Jenkins',
            'description' => 'Mercury transformed our textile shipping pipeline. Their document compliance is absolute, reducing custom clearance times from days to hours.',
            'value' => '5',
            'link' => 'Logistics Director',
            'subtitle' => 'Global Apparel Inc.',
            'icon' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $testimonialsSec->id,
            'title' => 'David Miller',
            'description' => 'With shipping space shortages, Mercury was the only partner that consistently guaranteed container allocations. Fantastic customer service and transparency.',
            'value' => '5',
            'link' => 'Supply Chain Manager',
            'subtitle' => 'EuroTech Goods',
            'icon' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
            'order' => 2,
        ]);

        // Home Section 16: Get in Touch
        Section::create([
            'page_id' => $home->id,
            'type' => 'get_in_touch',
            'heading' => 'Need Cargo Transport Solutions?',
            'subheading' => 'ROUTE · COMMUNICATE',
            'body' => 'Get in touch with our operations desk to coordinate your next shipment manifest.',
            'order' => 16,
        ]);

        // Home Section 17: Full-width CTA Banner
        Section::create([
            'page_id' => $home->id,
            'type' => 'cta_banner',
            'heading' => 'Ready to Secure Your Supply Chain?',
            'subheading' => 'CALL TO ACTION',
            'body' => 'Get in touch with our expert logistics coordinators today and receive a customized freight plan.',
            'cta_primary_btn_text' => 'Get an Instant Quote',
            'cta_primary_btn_url' => '/contact',
            'cta_secondary_btn_text' => 'Explore Services',
            'cta_secondary_btn_url' => '/services',
            'order' => 17,
        ]);

        // Home Section 18: Logistics Image Banner
        $logisticsBanner = Section::create([
            'page_id' => $home->id,
            'type' => 'logistics_image_banner',
            'heading' => 'Reliable Global Shipping and Customs Expertise',
            'subheading' => 'MERCURY BANGLADESH',
            'body' => 'We manage logistics complexities so you can focus on growing your business globally.',
            'order' => 18,
        ]);

        SectionItem::create([
            'section_id' => $logisticsBanner->id,
            'title' => 'Background',
            'value' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=1600&auto=format&fit=crop&q=80',
            'order' => 1,
        ]);

        SectionItem::create([
            'section_id' => $logisticsBanner->id,
            'title' => 'CTA',
            'description' => 'Speak with an Expert',
            'link' => '/contact',
            'order' => 2,
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
