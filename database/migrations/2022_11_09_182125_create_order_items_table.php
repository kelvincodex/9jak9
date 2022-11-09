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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id("orderItemsId");
            $table->foreignId("orderItemsProductId")
                    ->constrained('products', 'productId');
            $table->foreignId("orderItemsOrderId")
                    ->constrained('orders', 'orderId')
                    ->onDelete('cascade');
            $table->decimal("orderItemsTotalPrice")->nullable();
            $table->string("orderItemsQuantity")->nullable();
            $table->string("orderItemsStatus")->default("Active");
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
        Schema::dropIfExists('order_items');
    }
};
