<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_media', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID as the primary key
            $table->uuid('article_id'); // Foreign key referencing articles table
            $table->string('media_url'); // URL for the media
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade'); // Delete media if the article is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_media');
    }
}
