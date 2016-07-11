<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToLessonWords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lesson_words', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lesson_words', function (Blueprint $table) {
            $table->dropForeign('lesson_words_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
