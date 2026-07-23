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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_name')->nullable();
            $table->string('category')->default('Certification'); // Certification, Membership, License, Award, Accreditation, Affiliation
            $table->string('issuing_organization');
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('certificate_number')->nullable();
            $table->text('short_description')->nullable();
            $table->text('detailed_description')->nullable();
            $table->string('official_website_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('certificate_image')->nullable();
            $table->string('certificate_pdf')->nullable();
            $table->string('background_image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // Insert initial certifications
        $certifications = [
            [
                'title' => 'ISO 9001:2015 Quality Management Systems Certification',
                'short_name' => 'ISO 9001:2015',
                'category' => 'Certification',
                'issuing_organization' => 'International Organization for Standardization (ISO) / SGS',
                'issue_date' => '2021-03-15',
                'expiry_date' => '2027-03-14',
                'certificate_number' => 'ISO-QMS-BD-9001-2021',
                'short_description' => 'Certified international standard for Quality Management System ensuring consistent high-quality ocean, air, and multimodal logistics operations.',
                'detailed_description' => 'Mercury Bangladesh maintains ISO 9001:2015 accreditation covering all core supply chain services including customs brokerage, warehousing, freight forwarding, and international transportation management. Standardized operations guarantee operational excellence, strict compliance, risk management, and customer satisfaction across global trade lanes.',
                'official_website_url' => 'https://www.iso.org',
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'IATA Accredited Cargo Agent',
                'short_name' => 'IATA Cargo Agent',
                'category' => 'Accreditation',
                'issuing_organization' => 'International Air Transport Association (IATA)',
                'issue_date' => '2018-06-01',
                'expiry_date' => null,
                'certificate_number' => 'IATA-73-2-9821',
                'short_description' => 'Official accreditation authorizing direct air cargo booking, priority airway bill issuance, and international airline carrier management.',
                'detailed_description' => 'As an IATA Endorsed Cargo Agent, Mercury Bangladesh holds direct ticketing and air freight allocation privileges with top global passenger and freighter airlines operating out of Hazrat Shahjalal International Airport (DAC) and regional international gateways.',
                'official_website_url' => 'https://www.iata.org',
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FIATA Federation Member',
                'short_name' => 'FIATA Member',
                'category' => 'Membership',
                'issuing_organization' => 'International Federation of Freight Forwarders Associations (FIATA)',
                'issue_date' => '2019-01-10',
                'expiry_date' => null,
                'certificate_number' => 'FIATA-BD-44219',
                'short_description' => 'Full active member of FIATA enabling worldwide standardized negotiable bill of lading documentation and international logistics network support.',
                'detailed_description' => 'Membership in FIATA confirms Mercury Bangladesh\'s compliance with global freight forwarding standards, liability protocols, and unified international shipping procedures across 150+ countries.',
                'official_website_url' => 'https://fiata.org',
                'order' => 3,
                'is_active' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BAFFA Licensed Freight Forwarder',
                'short_name' => 'BAFFA Member',
                'category' => 'Affiliation',
                'issuing_organization' => 'Bangladesh Freight Forwarders Association (BAFFA)',
                'issue_date' => '2015-08-20',
                'expiry_date' => null,
                'certificate_number' => 'BAFFA-REG-0184',
                'short_description' => 'Licensed active member of Bangladesh Freight Forwarders Association governing national customs and logistics regulatory standards.',
                'detailed_description' => 'Mercury Bangladesh is a long-standing certified member of BAFFA, actively contributing to trade facilitation, port authority coordination, and national customs compliance policies at Chattogram Sea Port and Dhaka Airport.',
                'official_website_url' => 'http://baffa-bd.org',
                'order' => 4,
                'is_active' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WCA World Cargo Alliance Premier Partner',
                'short_name' => 'WCA Partner',
                'category' => 'Membership',
                'issuing_organization' => 'WCA World Alliance Network',
                'issue_date' => '2020-11-05',
                'expiry_date' => '2027-11-04',
                'certificate_number' => 'WCA-MEM-88910',
                'short_description' => 'Vetted member of the world\'s largest independent freight forwarder alliance guaranteeing financial safety and global destination coverage.',
                'detailed_description' => 'WCA World membership provides Mercury Bangladesh with instant agency connections and financial transaction guarantees across 190 countries, enabling seamless door-to-door delivery worldwide.',
                'official_website_url' => 'https://www.wcaworld.com',
                'order' => 5,
                'is_active' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('certifications')->insert($certifications);

        // Add certifications section to home page
        $homePage = DB::table('pages')->where('slug', 'home')->first();
        if ($homePage) {
            $existingSection = DB::table('sections')->where('page_id', $homePage->id)->where('type', 'certifications')->first();
            if (!$existingSection) {
                $maxOrder = DB::table('sections')->where('page_id', $homePage->id)->max('order') ?? 11;
                DB::table('sections')->insert([
                    'page_id' => $homePage->id,
                    'type' => 'certifications',
                    'heading' => 'Certifications & Accreditations',
                    'subheading' => 'TRUST & COMPLIANCE · GLOBAL STANDARDS',
                    'body' => 'Mercury Bangladesh operates under globally recognized quality standards, international shipping licenses, and freight forwarding memberships to ensure complete regulatory compliance.',
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
        DB::table('sections')->where('type', 'certifications')->delete();
        Schema::dropIfExists('certifications');
    }
};
