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
        Schema::create('service_levels', function (Blueprint $table) {
            $table->id("serviceLevelId");
            $table->string("serviceLevelName")->nullable();
            $table->string("serviceLevelPrice")->nullable();
            $table->string("serviceLevelDescription")->nullable();
            $table->string("serviceLevelProgramMethod")->nullable();
            $table->string("serviceLevelStatus")->default("Active");
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
        Schema::dropIfExists('service_levels');
    }
};
