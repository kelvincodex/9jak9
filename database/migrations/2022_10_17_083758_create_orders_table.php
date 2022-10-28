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
            $table->id("orderId");
            $table->string("orderTotalPrice")->nullable();
            $table->string("orderAddress")->nullable();
            $table->string("orderFullName")->nullable();
            $table->string("orderEmail")->nullable();
            $table->string("orderProductName")->nullable();
            $table->string("orderProductQuantity")->nullable();
            $table->string("orderProductVariation")->nullable();
            $table->string("orderProductPrice")->nullable();
            //todo foreign key for product
            $table->foreignId("orderProductId")
                ->constrained('products', 'productId')
                ->onDelete('cascade');
            $table->string("orderSubTotalPrice")->nullable();
            $table->string("orderStatus")->default("PENDING");
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
