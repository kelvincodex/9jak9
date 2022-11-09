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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id("orderDetailsId");
            $table->string("orderDetailsFirstName")->nullable();
            $table->string("orderDetailsLastName")->nullable();
            $table->string("orderDetailsEmail")->nullable();
            $table->string("orderDetailsPhone")->nullable();
            $table->string("orderDetailsAddress")->nullable();
            $table->string("orderDetailsCompany")->nullable();
            $table->text("orderDetailsNote")->nullable();
            $table->foreignId("orderDetailsOrderId")
                    ->constrained("orders", "orderId")
                    ->onDelete('cascade');
            $table->string("orderDetailsStatus")->default("Active");
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
        Schema::dropIfExists('order_details');
    }
};
