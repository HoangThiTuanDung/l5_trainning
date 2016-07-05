<?php

use Illuminate\Database\Seeder;

class LessonWordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\LessonWord', 20)->create();
    }
}
