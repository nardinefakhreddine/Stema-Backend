<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdAdditivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_additives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->foreign('product_id')->references("id")->on("products")->onDelete("set null")->onUpdate("cascade");
            $table->bigInteger("additive_id")->unsigned()->index()->nullable();
            $table->foreign("additive_id")->references("id")->on("additives")->onDelete("set null")->onUpdate("cascade");
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
        Schema::dropIfExists('prod_additives');
    }
}
