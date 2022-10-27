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
            $table->foreignId("orderCustomerId")
                    ->constrained('customers', 'customerId')->onDelete('cascade');
            $table->foreignId("orderDeliveryId")
                    ->constrained('deliveries', 'deliveryId')->onDelete('cascade');
            $table->string("orderTotalPrice")->nullable();
            $table->string("orderSubTotalPrice")->nullable();
            $table->string("orderStatus")->nullable();
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
