<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image', 500);
            $table->string('title', 500);
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('blog_date');

            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('youtube_link')->nullable();

            $table->string('blog_category', 500)->nullable();
            
            // Meta fields (NO after() allowed here)
            $table->string('meta_title', 500)->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();

            $table->enum('blog_status', ["live", "disabled"])->default("disabled");
            $table->integer('blog_sorting')->default(1)->index("blogs_index");
            $table->tinyInteger('status')->default(1);

            $table->bigInteger("created_by")->nullable();
            $table->bigInteger("updated_by")->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};