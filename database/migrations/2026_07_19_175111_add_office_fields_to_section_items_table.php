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
            $table->text('address')->nullable();
            $table->text('map_url')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('office_hours')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('section_items', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'map_url',
                'phone',
                'email',
                'office_hours',
                'emergency_contact',
                'latitude',
                'longitude',
            ]);
        });
    }
};
