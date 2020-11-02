<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variant_options', function (Blueprint $table) {
            $table->id();
            $table->integer('product_variant_id');
            $table->string('title');
            $table->string('quantity');
            $table->integer('sku');
            $table->boolean('is_unlimited')->default(0);
            $table->boolean('is_default')->default(0);
            $table->integer('brand_id')->nullable();
            $table->string('slug');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            //price add on relations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variant_options');
    }
}
