<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_allergies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->foreign('product_id')->references('id')->on("products")->onDelete("set null")->onUpdate("cascade");
            $table->bigInteger("allergy_id")->unsigned()->index()->nullable();
            $table->foreign("allergy_id")->references("id")->on("allergies")->onDelete("set null")->onUpdate("cascade");
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
        Schema::dropIfExists('prod_allergies');
    }
}
