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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description');
            $table->longText('full_description')->nullable();
            $table->string('type')->default('General'); // General, Holiday Notice, Maintenance, Shipping Delay, Service Update, Emergency Notice, Success Message, Information
            $table->string('priority')->default('Normal'); // Low, Normal, High, Critical
            $table->string('bg_color')->nullable(); // hex or CSS color
            $table->string('text_color')->nullable(); // hex or CSS color
            $table->string('icon')->nullable(); // Icon key/name
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_dismissible')->default(true);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('display_location')->default('top_bar'); // top_bar, banner, popup, inline
            $table->string('target_pages')->default('all'); // all, home, specific
            $table->json('specific_pages')->nullable(); // Array of routes or paths like ["/about", "/services"]
            $table->timestamps();
        });

        // Seed initial Announcement system settings in settings table
        $settings = [
            ['key' => 'announcement_system_enabled', 'value' => 'true', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'announcement_show_multiple', 'value' => 'true', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'announcement_max_items', 'value' => '5', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'announcement_auto_rotate', 'value' => 'true', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'announcement_animation_style', 'value' => 'slide', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'announcement_display_duration', 'value' => '5', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'announcement_sticky', 'value' => 'false', 'group' => 'announcement', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                $setting
            );
        }

        // Seed initial sample announcements
        DB::table('announcements')->insert([
            [
                'title' => 'Scheduled System Maintenance',
                'short_description' => 'Our online shipment tracking portal will undergo scheduled maintenance on Saturday between 02:00 AM and 04:00 AM UTC.',
                'full_description' => 'During this routine maintenance window, API integrations and shipment status updates may experience brief latency. Support channels remain operational via telephone and direct email.',
                'type' => 'Maintenance',
                'priority' => 'Normal',
                'bg_color' => '#0284c7',
                'text_color' => '#ffffff',
                'icon' => 'Wrench',
                'button_text' => 'View Schedule',
                'button_url' => '/contact',
                'display_order' => 1,
                'is_active' => true,
                'is_pinned' => true,
                'is_dismissible' => true,
                'start_date' => null,
                'end_date' => null,
                'display_location' => 'top_bar',
                'target_pages' => 'all',
                'specific_pages' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Expanded Asia-Europe Air Cargo Routes Launched',
                'short_description' => 'Mercury Bangladesh introduces high-frequency express air freight service connecting Dhaka (DAC) with Frankfurt (FRA) & London (LHR).',
                'full_description' => 'With guaranteed weekly capacity allocation and expedited customs clearance, our enhanced air charter & scheduled routes ensure faster door-to-door transit times for garment exports and high-value cargo.',
                'type' => 'Service Update',
                'priority' => 'High',
                'bg_color' => '#059669',
                'text_color' => '#ffffff',
                'icon' => 'Plane',
                'button_text' => 'Explore Routes',
                'button_url' => '/services',
                'display_order' => 2,
                'is_active' => true,
                'is_pinned' => false,
                'is_dismissible' => true,
                'start_date' => null,
                'end_date' => null,
                'display_location' => 'top_bar',
                'target_pages' => 'all',
                'specific_pages' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
        DB::table('settings')->where('group', 'announcement')->delete();
    }
};
