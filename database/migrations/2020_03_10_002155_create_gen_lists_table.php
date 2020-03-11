<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('item_id');
            $table->string('item_description');
            $table->string('item_cod')->nullable();
            $table->integer('enabled');
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
        Schema::dropIfExists('gen_lists');
    }
}
