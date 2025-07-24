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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->unique(); // home, about, contact, etc
            $table->string('title');
            $table->text('description');
            $table->text('keywords')->nullable();
            $table->string('author')->nullable();
            $table->string('robots')->default('index, follow');
            $table->string('language')->default('Indonesia');
            $table->string('revisit_after')->default('7 days');
            $table->string('geo_region')->nullable();
            $table->string('geo_placename')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image_width')->default('1200');
            $table->string('og_image_height')->default('630');
            $table->string('og_type')->default('website');
            $table->string('og_site_name')->nullable();
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->text('pinterest_description')->nullable();
            $table->string('msapplication_tile_color')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
