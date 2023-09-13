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
        Schema::create('code_product_zip', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBitInteger('zip_code_id');
            $table->foreignId('zip_code_id')->references('id')->on('zip_codes')->onDelete('cascade');

            // $table->unsignedBitInteger('product_id');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('zip_code_product');
    }
};
