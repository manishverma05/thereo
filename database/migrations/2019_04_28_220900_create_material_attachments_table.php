<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 100)->unique();
            $table->integer('material_id');
            $table->string('file', 191);
            $table->string('title', 191)->nullable();
            $table->string('alt', 191)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->integer('created_by');
            $table->integer('modified_by')->nullable();
            $table->enum('type', ['image', 'video','other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_attachments');
    }
}
