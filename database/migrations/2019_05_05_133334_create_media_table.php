<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 100)->unique();
            $table->string('file', 191);
            $table->string('title', 191)->nullable();
            $table->string('alt', 191)->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('media');
    }

}
