<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('code');
            $table->string('name');
            $table->dateTime('purchase_at');
            $table->integer('purchase_price');
            $table->text('description')->nullable();
            $table->boolean('status');
            $table->string('model');
            $table->string('brand');
            $table->text('image');
            $table->integer("category_id")->unsigned()->nullable();
            $table->integer("asset_part_of")->unsigned()->nullable();
            $table->integer("type_id")->unsigned()->nullable();
            $table->integer("location_id")->unsigned()->nullable();

            $table->foreign("category_id")->references("id")->on("category_asset");
            $table->foreign("asset_part_of")->references("id")->on("asset");
            $table->foreign("type_id")->references("id")->on("type_asset");
            $table->foreign("location_id")->references("id")->on("location_asset");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset');
    }
}
