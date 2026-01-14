<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();  // primary key

            $table->string('banner_image')->nullable();
            $table->json('gallery_images')->nullable(); // multiple images stored as JSON
            $table->string('heading_top'); // Service Name
            $table->string('slug')->unique();
            $table->string('heading_middle')->nullable(); // short description
            $table->text('long_description')->nullable(); // detailed description

            // SEO fields
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();

            $table->enum('slide_status', ['live', 'disabled'])->default('live');
            $table->integer('slide_sorting')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
