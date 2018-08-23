<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_markers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id')->index(); // Owner
            $table->decimal('latitude', 10, 6)->index();
            $table->decimal('longitude', 10, 6)->index();
            $table->json('settings')->nullable();
            $table->boolean('major')->default(0);
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
        Schema::dropIfExists('map_markers');
    }
}
