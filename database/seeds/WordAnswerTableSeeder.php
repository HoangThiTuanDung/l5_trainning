<?php

use Illuminate\Database\Seeder;

class WordAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\WordAnswer', 10)->create();
    }
}
