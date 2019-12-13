<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissingPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('dob');
            $table->string('gender');
            $table->string('height');
            $table->string('weight');
            $table->string('hair_color');
            $table->string('eye_color');
            $table->string('skin_color');
            $table->string('missing_from');
            $table->string('clothing_description');
            $table->string('unique_identifiers');
            $table->string('date_missing');
            $table->text('details');
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
        Schema::dropIfExists('missing_persons');
    }
}
