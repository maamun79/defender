<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('offenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('criminal_id')->unsigned();
            $table->string('title');
            $table->string('location');
            $table->string('date');
            $table->string('detain_date');
            $table->string('release_date');
            $table->string('release_type');
            $table->string('statute');
            $table->string('judgment');
            $table->string('victim_gender');
            $table->string('victim_age');

            $table->foreign('criminal_id')
                  ->references('id')->on('criminals')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('offenses');
    }
}
