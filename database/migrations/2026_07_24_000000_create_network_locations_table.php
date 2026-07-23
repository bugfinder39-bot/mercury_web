<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('network_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('region')->nullable();
            $table->string('type')->default('Branch Office'); // Corporate Office, Branch Office, Warehouse, Sea Port, Air Port, Partner Office, Agent, Distribution Center
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->text('address');
            $table->string('google_maps_url')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->string('marker_color')->nullable()->default('#0284c7');
            $table->string('marker_icon')->nullable()->default('Building2');
            $table->timestamps();
        });

        // Insert initial global logistics locations
        $locations = [
            [
                'name' => 'Mercury Bangladesh Corporate HQ',
                'country' => 'Bangladesh',
                'city' => 'Dhaka',
                'region' => 'Dhaka Division',
                'type' => 'Corporate Office',
                'latitude' => 23.7952445,
                'longitude' => 90.4026857,
                'address' => 'House 45, Road 11, Banani, Dhaka-1213, Bangladesh',
                'google_maps_url' => 'https://maps.google.com/?q=23.7952445,90.4026857',
                'phone' => '+880 2 9876543',
                'email' => 'dhaka@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'Central corporate headquarters managing global ocean, air, and customs brokerage operations.',
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
                'marker_color' => '#0284c7',
                'marker_icon' => 'Building2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chattogram Sea Port Logistics Hub',
                'country' => 'Bangladesh',
                'city' => 'Chattogram',
                'region' => 'Chattogram Division',
                'type' => 'Sea Port',
                'latitude' => 22.3254320,
                'longitude' => 91.8154320,
                'address' => 'Chamber House, 38 Agrabad C/A, Chattogram-4100, Bangladesh',
                'google_maps_url' => 'https://maps.google.com/?q=22.325432,91.815432',
                'phone' => '+880 31 765432',
                'email' => 'ctg@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'Dedicated sea freight & port operations hub handling ocean container shipping manifests.',
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
                'marker_color' => '#0d9488',
                'marker_icon' => 'Anchor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hazrat Shahjalal Air Cargo Terminal Desk',
                'country' => 'Bangladesh',
                'city' => 'Dhaka',
                'region' => 'Dhaka Division',
                'type' => 'Air Port',
                'latitude' => 23.8433000,
                'longitude' => 90.3978000,
                'address' => 'Cargo Village, HS International Airport, Kurmitola, Dhaka-1229',
                'google_maps_url' => 'https://maps.google.com/?q=23.8433,90.3978',
                'phone' => '+880 2 8901234',
                'email' => 'aircargo@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => '24/7 express air freight clearance and dispatch center at Dhaka International Airport.',
                'order' => 3,
                'is_active' => true,
                'is_featured' => true,
                'marker_color' => '#f59e0b',
                'marker_icon' => 'Plane',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Singapore Southeast Asia Transit Hub',
                'country' => 'Singapore',
                'city' => 'Singapore',
                'region' => 'Central Region',
                'type' => 'Distribution Center',
                'latitude' => 1.2902700,
                'longitude' => 103.8519590,
                'address' => '10 Changi South Street 2, Singapore 486596',
                'google_maps_url' => 'https://maps.google.com/?q=1.29027,103.851959',
                'phone' => '+65 6789 0123',
                'email' => 'singapore@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'Primary Southeast Asian maritime transshipment hub connecting Asia-Pacific trade lanes.',
                'order' => 4,
                'is_active' => true,
                'is_featured' => true,
                'marker_color' => '#6366f1',
                'marker_icon' => 'Warehouse',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rotterdam European Gate Hub',
                'country' => 'Netherlands',
                'city' => 'Rotterdam',
                'region' => 'South Holland',
                'type' => 'Sea Port',
                'latitude' => 51.9244200,
                'longitude' => 4.4777330,
                'address' => 'Willemsplein 2, 3016 DN Rotterdam, Netherlands',
                'google_maps_url' => 'https://maps.google.com/?q=51.92442,4.477733',
                'phone' => '+31 10 987 6543',
                'email' => 'rotterdam@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'European ocean freight gateway coordinating container customs clearance for EU destinations.',
                'order' => 5,
                'is_active' => true,
                'is_featured' => true,
                'marker_color' => '#0d9488',
                'marker_icon' => 'Anchor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dubai Middle East Logistics Center',
                'country' => 'United Arab Emirates',
                'city' => 'Dubai',
                'region' => 'Jebel Ali Free Zone',
                'type' => 'Warehouse',
                'latitude' => 24.9857000,
                'longitude' => 55.0272000,
                'address' => 'JAFZA One, Jebel Ali Free Zone, Dubai, UAE',
                'google_maps_url' => 'https://maps.google.com/?q=24.9857,55.0272',
                'phone' => '+971 4 881 2345',
                'email' => 'dubai@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'State-of-the-art bonded consolidation warehouse for MENA trade operations.',
                'order' => 6,
                'is_active' => true,
                'is_featured' => false,
                'marker_color' => '#e11d48',
                'marker_icon' => 'Warehouse',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shanghai Far East Partner Desk',
                'country' => 'China',
                'city' => 'Shanghai',
                'region' => 'Pudong New Area',
                'type' => 'Partner Office',
                'latitude' => 31.2304000,
                'longitude' => 121.4737000,
                'address' => 'Century Avenue, Pudong New Area, Shanghai 200120, China',
                'google_maps_url' => 'https://maps.google.com/?q=31.2304,121.4737',
                'phone' => '+86 21 6888 9900',
                'email' => 'shanghai@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'Commercial partner office overseeing Far East export allocations and supplier coordination.',
                'order' => 7,
                'is_active' => true,
                'is_featured' => false,
                'marker_color' => '#8b5cf6',
                'marker_icon' => 'Users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'London UK Regional Office',
                'country' => 'United Kingdom',
                'city' => 'London',
                'region' => 'Greater London',
                'type' => 'Branch Office',
                'latitude' => 51.5074000,
                'longitude' => -0.1278000,
                'address' => '1 Canada Square, Canary Wharf, London E14 5AA, UK',
                'google_maps_url' => 'https://maps.google.com/?q=51.5074,-0.1278',
                'phone' => '+44 20 7946 0912',
                'email' => 'london@mercurybd.com',
                'website' => 'https://mercurybd.com',
                'description' => 'United Kingdom liaison office handling retail client import manifests and customs clearance.',
                'order' => 8,
                'is_active' => true,
                'is_featured' => true,
                'marker_color' => '#0284c7',
                'marker_icon' => 'Building2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('network_locations')->insert($locations);

        // Ensure home page has global_network section
        $homePage = DB::table('pages')->where('slug', 'home')->first();
        if ($homePage) {
            $existingSection = DB::table('sections')->where('page_id', $homePage->id)->where('type', 'global_network')->first();
            if (!$existingSection) {
                // Get max order
                $maxOrder = DB::table('sections')->where('page_id', $homePage->id)->max('order') ?? 10;
                DB::table('sections')->insert([
                    'page_id' => $homePage->id,
                    'type' => 'global_network',
                    'heading' => 'Global Logistics Network',
                    'subheading' => 'GLOBAL REACH · STRATEGIC HUBS',
                    'body' => 'Discover Mercury Bangladesh’s extensive worldwide logistics coverage spanning major ocean sea ports, air cargo terminals, warehousing hubs, and strategic trade partners across continents.',
                    'order' => $maxOrder + 1,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('sections')->where('type', 'global_network')->delete();
        Schema::dropIfExists('network_locations');
    }
};
