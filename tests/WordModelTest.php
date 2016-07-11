<?php

use App\LessonWord;
use App\Word;
use App\WordAnswer;
use Illuminate\Support\Facades\Auth;

class WordModelTest extends TestCase
{

	public function testCanCreateWord()
	{
        $word = Word::create([
            'content' => 'content',
            'category_id' => 1,
            'lesson_id' => 1
        ]);

        $this->assertNotEmpty($word);
        $this->assertEquals('content', $word->content);
        $this->assertEquals(1, $word->category_id);
	}

    public function testCanDeleteWord()
    {
        $word = factory('App\Word')->create();
        $wordID = $word->id;

        $this->assertTrue($word->delete());
        $this->assertNull(Word::find($wordID));
    }

    public function testCanUpdateWord()
    {
        $word = Word::find(1);
        $word->content = 'update';
        $word->category_id = 2;

        $this->assertTrue($word->save());
        $this->assertEquals('update', $word->content);
        $this->assertEquals(2, $word->category_id);
    }

    public function testRelationshipWithCategory()
    {
        Auth::loginUsingId(1);

        $word = factory('App\Word')->create();

        $this->assertEquals($word->category_id, $word->category->id);
    }

    public function testRelationshipWithLesson()
    {
        Auth::loginUsingId(1);

        $word = factory('App\Word')->create();

        $this->assertEquals($word->lesson_id, $word->lesson->id);
    }

    public function testRelationshipWithLessonWords()
    {
        Auth::loginUsingId(1);
        $word = Word::find(1);

        $lessonWords = factory(App\LessonWord::class, 2)->create([
            'user_id' => Auth::id(),
            'lesson_id' => 1,
            'word_id' => $word->id,
            'word_answer_id' => 1
        ]);

        foreach ($lessonWords as $item) {
            $this->assertEquals($item->word_id, $item->word->id);
        }
    }

    public function testRelationshipWithWordAnswers()
    {
        Auth::loginUsingId(1);
        $word = Word::find(1);

        $wordAnswers = factory(App\WordAnswer::class, 2)->create([
            'content' => 'abc',
            'word_id' => $word->id,
            'correct' => 1
        ]);

        foreach ($wordAnswers as $wordAnswer){
            $this->assertEquals($wordAnswer->word_id, $wordAnswer->word->id);
        }
    }
}
