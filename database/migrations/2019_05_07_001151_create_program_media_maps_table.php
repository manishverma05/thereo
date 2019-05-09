<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramMediaMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_media_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_id');
            $table->integer('media_id');
            $table->enum('type', ['cover'])->default('cover');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_media_maps');
    }
}
