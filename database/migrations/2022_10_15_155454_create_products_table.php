<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('category_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('datasheet')->nullable();
            $table->string('price')->nullable();
            $table->string('discounted_price')->nullable();
            $table->string('discount_in_percentage')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->string('product_images')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('attribute_name')->nullable();
            $table->string('attribute_values')->nullable();
            $table->string('gender')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('delivery_charges')->nullable();
            $table->string('delivery_time')->nullable();
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
    }
};
