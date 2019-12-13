<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissingPersonLocationUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_person_location_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('missing_person_id')->unsigned();
            $table->string('where_seen');
            $table->string('clothing_details');
            $table->string('details')->nullable();
            $table->string('date_of_seen');
            $table->string('sender_name');
            $table->string('sender_contact');

            $table->foreign('missing_person_id')
                  ->references('id')->on('missing_persons')
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
        Schema::dropIfExists('missing_person_location_updates');
    }
}
