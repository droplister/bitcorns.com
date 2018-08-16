<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coop_id')->nullable()->index();
            $table->unsignedInteger('xcp_core_credit_id')->index(); // Creation Event
            $table->string('name')->unique();
            $table->string('address')->unique();
            $table->string('description');
            $table->string('image_url');
            $table->unsignedBigInteger('total_harvested')->default(0); // Convenience
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
        Schema::dropIfExists('farms');
    }
}
