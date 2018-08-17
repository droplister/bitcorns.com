<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('xcp_core_asset_name')->unique();
            $table->string('xcp_core_burn_tx_hash')->nullable()->index(); // Submission Fee
            $table->string('name')->unique(); // Convenience
            $table->string('type')->index();
            $table->string('image_url')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('museumed_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
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
        Schema::dropIfExists('tokens');
    }
}
