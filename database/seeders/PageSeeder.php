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

        $officesSec = Section::create([
            'page_id' => $contact->id,
            'type' => 'office_locations',
            'heading' => 'Our Office Locations',
            'subheading' => 'ROUTE · CHANNELS',
            'body' => 'We coordinate global shipping from key commercial centers in Bangladesh.',
            'order' => 2,
        ]);

        SectionItem::create([
            'section_id' => $officesSec->id,
            'title' => 'Dhaka Headquarters',
            'subtitle' => 'MB · 01',
            'description' => 'Our main operations office coordinating global air and sea freight logistics.',
            'address' => 'House 45, Road 11, Banani, Dhaka-1213, Bangladesh',
            'phone' => '+880 2 9876543',
            'email' => 'dhaka@mercurybd.com',
            'office_hours' => 'Sat - Thu: 9:00 AM - 6:00 PM',
            'emergency_contact' => '+880 1711 123456',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.1574693409153!2d90.4026857!3d23.7952445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c70c653ff56d%3A0x28976b9f71c4c1a2!2sBanani%20Graveyard!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd',
            'latitude' => '23.7952445',
            'longitude' => '90.4026857',
            'order' => 1,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $officesSec->id,
            'title' => 'Chattogram Branch',
            'subtitle' => 'MB · 02',
            'description' => 'Dedicated sea freight port operations hub near the Chittagong Port Authority.',
            'address' => 'Chamber House, 38 Agrabad C/A, Chattogram-4100, Bangladesh',
            'phone' => '+880 31 765432',
            'email' => 'ctg@mercurybd.com',
            'office_hours' => 'Sat - Thu: 9:00 AM - 6:00 PM',
            'emergency_contact' => '+880 1711 789012',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.165432!2d91.815432!3d22.325432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd8a1b2c3d4e5%3A0x67890abcdef12345!2sAgrabad%20C%2FA%2C%20Chattogram!5e0!3m2!1sen!2sbd!4v1700000000001!5m2!1sen!2sbd',
            'latitude' => '22.325432',
            'longitude' => '91.815432',
            'order' => 2,
            'is_active' => true,
        ]);

        $teamSec = Section::create([
            'page_id' => $contact->id,
            'type' => 'office_team',
            'heading' => 'Meet Our Office Team',
            'subheading' => 'PEOPLE · EXPERTISE',
            'body' => 'Get in touch directly with our key contact persons for immediate assistance.',
            'order' => 3,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $teamSec->id,
            'title' => 'Mahbubur Rahman',
            'value' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&auto=format&fit=crop&q=80',
            'description' => 'Over 20 years of experience in shipping, cargo logistics, and supply chain management.',
            'designation' => 'Managing Director & CEO',
            'department' => 'Executive',
            'office_location' => 'Dhaka Headquarters',
            'phone' => '+880 2 9876543',
            'mobile' => '+880 1711 123456',
            'whatsapp' => '+880 1711 123456',
            'email' => 'm.rahman@mercurybd.com',
            'extension' => '101',
            'linkedin_url' => 'https://linkedin.com/in/mahbubur-rahman',
            'facebook_url' => 'https://facebook.com/mahbubur-rahman',
            'order' => 1,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $teamSec->id,
            'title' => 'Kazi Masud',
            'value' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&auto=format&fit=crop&q=80',
            'description' => 'Coordinating sea freight operations, customs clearances, and port logistics in Chattogram.',
            'designation' => 'Operations Manager',
            'department' => 'Operations',
            'office_location' => 'Chattogram Branch',
            'phone' => '+880 31 765432',
            'mobile' => '+880 1711 789012',
            'whatsapp' => '+880 1711 789012',
            'email' => 'k.masud@mercurybd.com',
            'extension' => '201',
            'linkedin_url' => 'https://linkedin.com/in/kazi-masud',
            'order' => 2,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $teamSec->id,
            'title' => 'Tasnim Alam',
            'value' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80',
            'description' => 'Managing corporate client accounts, freight bookings, pricing negotiations, and sales.',
            'designation' => 'Sales Executive',
            'department' => 'Commercial / Sales',
            'office_location' => 'Dhaka Headquarters',
            'phone' => '+880 2 9876543',
            'mobile' => '+880 1711 555666',
            'whatsapp' => '+880 1711 555666',
            'email' => 't.alam@mercurybd.com',
            'extension' => '105',
            'linkedin_url' => 'https://linkedin.com/in/tasnim-alam',
            'order' => 3,
            'is_active' => true,
        ]);

        $formSec = Section::create([
            'page_id' => $contact->id,
            'type' => 'contact_form',
            'heading' => 'Send Us a Message',
            'subheading' => 'MESSAGE DESK',
            'body' => 'Our coordinators will review your cargo requirements immediately.',
            'form_card_title' => 'Send a Message',
            'form_description' => 'Our coordinators will review your cargo requirements immediately.',
            'button_text' => 'Send Message',
            'button_icon' => 'Send',
            'success_message' => 'Thank you! Your message has been received.',
            'error_message' => 'Failed to submit form. Please check input fields.',
            'required_field_text' => '*',
            'placeholder_text' => '',
            'order' => 4,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $formSec->id,
            'title' => 'Full Name',
            'field_name' => 'name',
            'field_type' => 'text',
            'placeholder' => 'John Doe',
            'is_required' => true,
            'width' => 'full',
            'order' => 1,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $formSec->id,
            'title' => 'Email Address',
            'field_name' => 'email',
            'field_type' => 'email',
            'placeholder' => 'john@example.com',
            'is_required' => true,
            'width' => 'full',
            'order' => 2,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $formSec->id,
            'title' => 'Phone Number',
            'field_name' => 'phone',
            'field_type' => 'phone',
            'placeholder' => '+880 17...',
            'is_required' => false,
            'width' => 'half',
            'order' => 3,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $formSec->id,
            'title' => 'Subject',
            'field_name' => 'subject',
            'field_type' => 'text',
            'placeholder' => 'Inquiry or Quote',
            'is_required' => false,
            'width' => 'half',
            'order' => 4,
            'is_active' => true,
        ]);

        SectionItem::create([
            'section_id' => $formSec->id,
            'title' => 'Message',
            'field_name' => 'message',
            'field_type' => 'textarea',
            'placeholder' => 'Describe shipping requirements...',
            'is_required' => true,
            'width' => 'full',
            'order' => 5,
            'is_active' => true,
        ]);

        // ==========================================================
        // 5. Coming Soon Page
        // ==========================================================
        $comingSoonPage = Page::create([
            'name' => 'Coming Soon',
            'slug' => 'coming-soon',
            'meta_title' => 'Coming Soon | Mercury Bangladesh (Pvt.) Ltd.',
            'meta_description' => 'Our next-generation corporate logistics and maritime operations portal is under active development. Check back soon for seamless supply chain tracking.',
        ]);

        // Coming Soon Section 1: Hero
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

        // Coming Soon Section 2: Work In Progress
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

        // Coming Soon Section 3: What To Expect
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

        // Coming Soon Section 4: Stay Connected / CTA
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
    }
}



