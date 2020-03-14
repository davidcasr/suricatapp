<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityPeopleRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_people', function (Blueprint $table) {
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community_people', function (Blueprint $table) {
            $table->dropForeign(['community_id']);
            $table->dropForeign(['person_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['profile_id']);
        });
    }
}
