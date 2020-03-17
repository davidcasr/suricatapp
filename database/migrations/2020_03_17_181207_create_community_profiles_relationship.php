<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityProfilesRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_profiles', function (Blueprint $table) {
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
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
        Schema::table('community_profiles', function (Blueprint $table) {
            $table->dropForeign(['community_id']);
            $table->dropForeign(['profile_id']);
        });
    }
}
