<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityMeetingsRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_meetings', function (Blueprint $table) {
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community_meetings', function (Blueprint $table) {
            $table->dropForeign(['community_id']);
            $table->dropForeign(['meeting_id']);
        });
    }
}
