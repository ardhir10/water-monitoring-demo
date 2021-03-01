<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('filename')->nullable();
            $table->integer("asset_id")->unsigned()->nullable();

            $table->foreign("asset_id")->references("id")->on("asset");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calibration');
    }
}
