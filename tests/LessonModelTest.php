<?php

use App\Activity;
use App\Lesson;
use App\LessonWord;
use App\Word;
use Illuminate\Support\Facades\Auth;

class LessonModelTest extends TestCase
{
    public function testCanCreateLesson()
    {
        Auth::loginUsingId(1);

        $data = ['name' => 'Lesson A',
            'user_id' => Auth::id(),
            'category_id' => 1,
            'result' => 1
        ];

        $lesson = Lesson::create($data);

        $this->assertNotEmpty($lesson);
        $this->assertEquals('Lesson A', $lesson->name);
        $this->assertEquals(1, $lesson->category_id);
    }

    public function testCanDeleteLesson()
    {
        $lesson = factory('App\Lesson')->create();
        $lessonID = $lesson->id;

        $this->assertTrue($lesson->delete());
        $this->assertNull(Lesson::find($lessonID));
    }

    public function testCanUpdateLesson()
    {
        $lesson = Lesson::find(1);
        $nameBeforeUpdate = $lesson->name;
        $lesson->name = 'update';

        $this->assertTrue($lesson->save());
        $this->assertEquals('update', $lesson->name);
        $this->assertTrue($nameBeforeUpdate != $lesson->name);
    }

    public function testRelationshipWithActivities()
    {
        Auth::loginUsingId(1);
        $lesson = Lesson::find(1);
        for ($i = 0; $i < 3; $i++) {
            $activity = new Activity;

            $activity->user_id = Auth::id();
            $activity->words_numbers = 1;

            $lesson->activities()->save($activity);

            $this->assertEquals($activity->lesson_id, $activity->lesson->id);
        }
    }

    public function testRelationshipWithLessonWords()
    {
        Auth::loginUsingId(1);
        $lesson = Lesson::find(1);

        $lessonWords = factory(App\LessonWord::class, 2)->create([
            'user_id' => Auth::id(),
            'word_id' => 1,
            'lesson_id' => $lesson->id,
            'word_answer_id' => 1
        ]);

        foreach ($lessonWords as $item) {
            $this->assertEquals($item->lesson_id, $item->lesson->id);
        }
    }

    public function testRelationshipWithCategory()
    {
        Auth::loginUsingId(1);

        $lesson = factory('App\Lesson')->create();

        $this->assertEquals($lesson->category_id, $lesson->category->id);
    }

    public function testRelationshipWithWords()
    {
        Auth::loginUsingId(1);
        $lesson = Lesson::find(1);

        $words = factory(App\Word::class, 2)->create([
            'content' => 'abc',
            'category_id' => 1,
            'lesson_id' => $lesson->id
        ]);

        foreach ($words as $word) {
            $this->assertEquals($word->lesson_id, $word->lesson->id);
        }
    }
}
