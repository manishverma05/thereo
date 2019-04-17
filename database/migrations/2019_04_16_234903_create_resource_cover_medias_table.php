<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceCoverMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_cover_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 100)->unique();
            $table->integer('resource_id');
            $table->string('file', 191);
            $table->string('title', 191)->nullable();
            $table->string('alt', 191)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->integer('created_by');
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('resource_cover_medias');
    }
}
