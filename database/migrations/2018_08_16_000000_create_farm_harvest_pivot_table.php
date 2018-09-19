<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmHarvestPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_harvest', function (Blueprint $table) {
            $table->unsignedInteger('farm_id')->index();
            $table->unsignedInteger('harvest_id')->index();
            $table->unsignedInteger('coop_id')->nullable()->index();
            $table->unsignedBigInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_harvest');
    }
}
