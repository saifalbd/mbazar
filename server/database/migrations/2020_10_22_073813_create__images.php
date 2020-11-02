<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('imageble', function (Blueprint $table) {
            $table->integer('image_id');
            $table->integer('imageble_id');
            $table->string('imageble_type');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name');
            $table->string('extension');
            $table->string('disk');
            $table->boolean('is_active')->default(0);
            $table->string('path')->nullable();
            $table->string('image_for')->default('product'); //product // avatar // category // brand
            $table->integer('model_id');
            $table->string('model_type');

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
        Schema::dropIfExists('_images');
    }
}
