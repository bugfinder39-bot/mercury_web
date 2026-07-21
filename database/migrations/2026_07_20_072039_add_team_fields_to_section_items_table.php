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
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('office_location')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('extension')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('section_items', function (Blueprint $table) {
            $table->dropColumn([
                'designation',
                'department',
                'office_location',
                'mobile',
                'whatsapp',
                'extension',
                'linkedin_url',
                'facebook_url',
            ]);
        });
    }
};
