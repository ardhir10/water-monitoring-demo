<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetBomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_bom', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer("asset_id")->unsigned()->nullable();
            $table->integer("bom_id")->unsigned()->nullable();

            $table->foreign("asset_id")->references("id")->on("asset");
            $table->foreign("bom_id")->references("id")->on("bom");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_bom');
    }
}
