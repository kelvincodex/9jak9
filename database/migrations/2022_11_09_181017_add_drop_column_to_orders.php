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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("orderProductVariation");
            $table->dropColumn("orderProductPrice");
            $table->dropColumn("orderProductName");
            $table->dropColumn("orderFullName");
            $table->dropColumn("orderAddress");
            $table->dropColumn("orderProductQuantity");
            $table->dropColumn("orderEmail");
            $table->dropForeign('orders_orderProductId_foreign');
            $table->dropColumn('orderProductId');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
