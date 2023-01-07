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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id("bankDetailsId");
            $table->string("bankDetailsName")->nullable();
            $table->string("bankDetailsNumber")->nullable();
            $table->string("bankDetailsSortCode")->nullable();
            $table->string("bankDetailsIban")->nullable();
            $table->string("bankDetailsBic")->nullable();
            $table->string("bankDetailsStatus")->default("Active");
            $table->softDeletes();
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
        Schema::dropIfExists('bank_details');
    }
};
