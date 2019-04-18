<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 100)->unique();
            $table->string('slug', 150)->unique();
            $table->string('title', 191);
            $table->string('cover_title', 191)->nullable();
            $table->text('description');
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->enum('status', ['0', '1'])->comment('0 : unpublished; 1 : published');
            $table->integer('created_by');
            $table->integer('modified_by')->nullable();
            $table->timestampTz('publish_on');
            $table->timestampTz('unpublish_on')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
