<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(WordTableSeeder::class);
        $this->call(WordAnswerTableSeeder::class);
    }
}
