<?php

use App\LessonWord;
use App\WordAnswer;
use Illuminate\Support\Facades\Auth;

class WordAnswerModelTest extends TestCase
{
    public function testCanCreateWordAnswer()
	{
		$wordAnswer = WordAnswer::create([
            'content' => 'abcd',
            'correct' => 1,
            'word_id' => 1
        ]);

        $this->assertNotEmpty($wordAnswer);
        $this->assertEquals('abcd', $wordAnswer->content);
        $this->assertEquals(1, $wordAnswer->correct);
	}

    public function testCanDeleteWordAnswer()
    {
        $wordAnswer = factory('App\WordAnswer')->create();

        $this->assertTrue($wordAnswer->delete());
    }

    public function testCanUpdateWordAnswer()
    {
        $wordAnswer = WordAnswer::find(1);
        $contentBeforeUpdate = $wordAnswer->content;
        $wordAnswer->content = 'update';
        $wordAnswer->save();

        $this->assertEquals('update', $wordAnswer->content);
        $this->assertTrue($contentBeforeUpdate != $wordAnswer->content);
    }

    public function testRelationshipWithWord()
    {
        Auth::loginUsingId(1);

        $wordAnswer = factory('App\WordAnswer')->create();

        $this->assertEquals($wordAnswer->word_id, $wordAnswer->word->id);
    }

    public function testRelationshipWithLessonWords()
    {
        Auth::loginUsingId(1);
        $wordAnswer = WordAnswer::find(1);

        $lessonWords = factory(App\LessonWord::class, 2)->create([
            'user_id' => Auth::id(),
            'word_id' => 1,
            'word_answer_id' => $wordAnswer->id,
            'lesson_id' => 1
        ]);

        foreach ($lessonWords as $item) {
            $this->assertEquals($item->word_id, $item->word->id);
        }
    }
}
