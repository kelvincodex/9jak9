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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id("transactionId");
            $table->string("transactionName")->nullable();
            $table->string("transactionEmail")->nullable();
            $table->string("transactionAmount")->nullable();
            //todo order id foreign key
            $table->foreignId("transactionOrderId")
                    ->constrained('orders', 'orderId');
            $table->string("transactionReference")->nullable();
            $table->string("transactionStatus")->default("ACTIVE");
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
        Schema::dropIfExists('transactions');
    }
};
