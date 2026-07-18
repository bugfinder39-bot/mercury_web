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
        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('signature_media_id')->references('id')->on('media')->onDelete('set null');
            $table->foreign('portrait_media_id')->references('id')->on('media')->onDelete('set null');
            $table->foreign('cta_background_media_id')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign(['signature_media_id']);
            $table->dropForeign(['portrait_media_id']);
            $table->dropForeign(['cta_background_media_id']);
        });
    }
};
