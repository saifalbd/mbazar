<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseTable extends Migration
{




    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('products', function (Blueprint $table) {
            $table->id();
           //categpries add on relations
            $table->integer('brand_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->json('rules')->default('{"isFeatured":true,"isFavorite":true,"isBest":true,"isTopSale":true}');
            $table->boolean('is_active')->default(false);
            $table->integer('sku');
            $table->text('description')->nullable();
            $table->timestamps();

             //price add on relations
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('price_type')->default('retail');//retail or wholesale or purchase
            $table->integer('price');
            $table->integer('compare_price')->nullable();
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

        Schema::dropIfExists('products');
        Schema::dropIfExists('prices');
    }
}
