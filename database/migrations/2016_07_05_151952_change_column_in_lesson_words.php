<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnInLessonWords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lesson_words', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->change();;
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
            $table->integer('user_id')->unsigned(true)->nullable(false)->change();;
        });
    }
}
