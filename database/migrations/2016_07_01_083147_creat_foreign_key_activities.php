<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatForeignKeyActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('lesson_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('lesson_id')->references('id')->on('lessons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->integer('user_id')->change();
            $table->integer('lesson_id')->change();
            $table->dropForeign('activities_user_id_foreign');
            $table->dropForeign('activities_lesson_id_foreign');
        });
    }
}
