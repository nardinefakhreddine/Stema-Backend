<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdNutritionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_nutritionals', function (Blueprint $table) {
            $table->id();
            $table->string('scale');
            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->foreign('product_id')->references('id')->on("products")->onDelete("set null")->onUpdate("cascade");;
            $table->bigInteger("nutri_id")->unsigned()->index()->nullable();
            $table->foreign("nutri_id")->references("id")->on("nutritional_facts")->onDelete("set null")->onUpdate("cascade");;
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
        Schema::dropIfExists('prod_nutritionals');
    }
}
