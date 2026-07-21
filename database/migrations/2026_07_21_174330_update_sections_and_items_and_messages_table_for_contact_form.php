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
            $table->string('form_card_title')->nullable()->after('cta_secondary_btn_url');
            $table->text('form_description')->nullable()->after('form_card_title');
            $table->string('button_text')->nullable()->after('form_description');
            $table->string('button_icon')->nullable()->after('button_text');
            $table->string('success_message')->nullable()->after('button_icon');
            $table->string('error_message')->nullable()->after('success_message');
            $table->string('required_field_text')->nullable()->after('error_message');
            $table->string('placeholder_text')->nullable()->after('required_field_text');
        });

        Schema::table('section_items', function (Blueprint $table) {
            $table->string('field_name')->nullable()->after('facebook_url');
            $table->string('field_type')->nullable()->after('field_name');
            $table->string('placeholder')->nullable()->after('field_type');
            $table->boolean('is_required')->default(false)->after('placeholder');
            $table->string('width')->default('full')->after('is_required'); // 'half' or 'full'
            $table->string('help_text')->nullable()->after('width');
            $table->string('default_value')->nullable()->after('help_text');
            $table->text('options')->nullable()->after('default_value'); // Comma-separated or json for dropdown/radio
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->json('data')->nullable()->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn([
                'form_card_title',
                'form_description',
                'button_text',
                'button_icon',
                'success_message',
                'error_message',
                'required_field_text',
                'placeholder_text',
            ]);
        });

        Schema::table('section_items', function (Blueprint $table) {
            $table->dropColumn([
                'field_name',
                'field_type',
                'placeholder',
                'is_required',
                'width',
                'help_text',
                'default_value',
                'options',
            ]);
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('data');
        });
    }
};
