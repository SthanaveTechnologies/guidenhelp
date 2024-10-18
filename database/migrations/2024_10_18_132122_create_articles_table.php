<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Set UUID as the primary key
            $table->string('title'); // Title of the article
            $table->text('description'); // Full description of the article
            $table->text('short_description'); // Short description of the article
            $table->uuid('cat_id')->nullable(); // Use UUID for the foreign key
            $table->unsignedBigInteger('created_by')->nullable(); // Use UUID for the foreign key
            $table->softDeletes(); // Soft delete column
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('set null'); 
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
