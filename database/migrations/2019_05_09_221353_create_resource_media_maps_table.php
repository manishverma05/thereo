<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceMediaMapsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('resource_media_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resource_id');
            $table->integer('media_id');
            $table->enum('type', ['product','media','cover','external'])->default('cover');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('resource_media_maps');
    }

}
