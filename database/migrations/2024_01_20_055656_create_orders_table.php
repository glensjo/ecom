<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('size')->nullable();
            $table->text('custom_description')->nullable();
            $table->string('design_image');
            $table->integer('qty');
            $table->string('company')->nullable();
            $table->string('payment_image');
            $table->string('status');
            $table->string('reason')->nullable();
            $table->decimal('subtotal',8,3);
            $table->decimal('tax',8,3);
            $table->decimal('total',8,3);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
