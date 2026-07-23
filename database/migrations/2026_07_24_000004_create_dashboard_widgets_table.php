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
        Schema::create('dashboard_widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('widget_key');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('icon')->default('LayoutGrid');
            $table->string('bg_style')->default('default'); // default, glass, gradient, card, dark
            $table->string('chart_type')->default('line'); // line, bar, pie, area, mini
            $table->string('size')->default('medium'); // small (3), medium (4), large (6), full (12)
            $table->integer('display_order')->default(0);
            $table->integer('refresh_interval')->default(0); // in seconds, 0 = disabled
            $table->string('animation')->default('fade'); // fade, pulse, none
            $table->boolean('is_enabled')->default(true);
            $table->string('permission_role')->default('all'); // all, admin, super_admin
            $table->json('custom_settings')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'display_order']);
            $table->index(['widget_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_widgets');
    }
};
