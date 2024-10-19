<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->char('parent_id', 36)->nullable()->change(); // Change parent_id to char(36) for UUID
        });
    }
    
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->change(); // Revert back to the original data type if necessary
        });
    }
};
