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
            // CEO Message fields
            $table->text('ceo_rich_text')->nullable()->after('type');
            $table->string('ceo_name')->nullable()->after('ceo_rich_text');
            $table->string('ceo_designation')->nullable()->after('ceo_name');
            $table->unsignedBigInteger('signature_media_id')->nullable()->after('ceo_designation');
            $table->unsignedBigInteger('portrait_media_id')->nullable()->after('signature_media_id');
            $table->string('ceo_cta_button_text')->nullable()->after('portrait_media_id');
            $table->string('ceo_cta_button_url')->nullable()->after('ceo_cta_button_text');
            // CTA Banner fields
            $table->string('cta_banner_heading')->nullable()->after('ceo_cta_button_url');
            $table->string('cta_banner_subheading')->nullable()->after('cta_banner_heading');
            $table->unsignedBigInteger('cta_background_media_id')->nullable()->after('cta_banner_subheading');
            $table->string('cta_primary_btn_text')->nullable()->after('cta_background_media_id');
            $table->string('cta_primary_btn_url')->nullable()->after('cta_primary_btn_text');
            $table->string('cta_secondary_btn_text')->nullable()->after('cta_primary_btn_url');
            $table->string('cta_secondary_btn_url')->nullable()->after('cta_secondary_btn_text');

            // Foreign keys omitted for now; can be added in a later migration if needed
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
            $table->dropColumn([
                'ceo_rich_text',
                'ceo_name',
                'ceo_designation',
                'signature_media_id',
                'portrait_media_id',
                'ceo_cta_button_text',
                'ceo_cta_button_url',
                'cta_banner_heading',
                'cta_banner_subheading',
                'cta_background_media_id',
                'cta_primary_btn_text',
                'cta_primary_btn_url',
                'cta_secondary_btn_text',
                'cta_secondary_btn_url',
            ]);
        });
    }
};
