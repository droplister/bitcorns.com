<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coops', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id')->nullable()->index(); // Owner
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('image_url')->nullable();
            $table->text('content');
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
        Schema::dropIfExists('coops');
    }
}
