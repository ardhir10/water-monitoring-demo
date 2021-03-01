<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer("bom_id")->unsigned()->nullable();
            $table->integer("material_id")->unsigned()->nullable();

            $table->foreign("bom_id")->references("id")->on("bom");
            $table->foreign("material_id")->references("id")->on("material");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bom_material');
    }
}
