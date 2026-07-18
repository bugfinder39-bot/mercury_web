<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('section_items', function (Blueprint $table) {
            // Add fields for image gallery items
            $table->unsignedBigInteger('image_media_id')->nullable()->after('link');
            $table->string('alt_text')->nullable()->after('image_media_id');

            // Foreign key to media library
            // (If the media table is created by another package or system, we reference it, or if it doesn't exist, we can create/comment it or see where it is)
            // Wait, does the media table exist? Let's check.
            // If it is not created yet, we might get an error because the 'media' table doesn't exist.
            // Let's check where the media table is or if we can make it a simple column without foreign key constraint, or create the media table.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('section_items', function (Blueprint $table) {
            $table->dropColumn(['image_media_id', 'alt_text']);
        });
    }
};
