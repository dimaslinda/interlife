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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('design_style')->nullable(); // Gaya Desain
            $table->string('frame_material')->nullable(); // Rangka
            $table->string('finishing')->nullable(); // Finishing
            $table->decimal('rating', 2, 1)->default(5.0); // Rating 1-5
            $table->text('testimonial')->nullable(); // Testimoni client
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
