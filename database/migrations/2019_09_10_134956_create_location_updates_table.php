<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('criminal_id')->unsigned();
            $table->string('location');
            $table->string('description')->nullable();
            $table->string('sender_contact');

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
        Schema::dropIfExists('location_updates');
    }
}
