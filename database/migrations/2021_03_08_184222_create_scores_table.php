<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->text('descripion');
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
        Schema::dropIfExists('scores');
    }
}
/**$table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('barecode')->unique()->nullable();
            $table->bigInteger("score_id")->unsigned()->index();
            $table->foreign("score_id")->references("id")->on("scores")->onDelete("set null")->onUpdate('cascade');;
            $table->string('brand');
            $table->text('description');
            $table->string('image');
            $table->timestamps(); */