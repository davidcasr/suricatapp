<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeetingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('person_id');
            $table->string('name');
            $table->text('description');
            $table->dateTime('date');
            $table->string('address');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meetings');
    }
}
