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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->decimal('grand_total', 20, 6)->nullable();
            $table->unsignedInteger('item_count')->nullable();

            $table->boolean('payment_status')->nullable();
            $table->string('payment_method')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
