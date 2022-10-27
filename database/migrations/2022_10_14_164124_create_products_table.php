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
        Schema::create('products', function (Blueprint $table) {
            $table->id("productId");
            $table->string("productName")->nullable();
            $table->float("productSellingPrice")->default(0);
            $table->float("productOfferPrice")->default(0);
            $table->string("productImage")->nullable();
            $table->longText("productDescription")->nullable();
            $table->string("productDiscount")->nullable();
            //todo foreign key for brands
            $table->foreignId("productBrandId")
                ->constrained('brands', 'brandId')
                ->onDelete('cascade');

            //todo foreign key for category
            $table->foreignId("productCategoryId")
                ->constrained('categories', 'categoryId')
                ->onDelete('cascade');
            $table->string("productQuantity")->nullable();
            $table->string("productStatus")->default("Active");
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
        Schema::dropIfExists('products');
    }
};
