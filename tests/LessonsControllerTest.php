<?php

use App\Lesson;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class LessonsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testIfUserNotLogin()
    {
        $resp = $this->call('GET', '/lessons/1');

        $this->assertEquals(302, $resp->getStatusCode());
        $this->assertTrue($resp->isRedirect($this->baseUrl . '/login'));
    }

    public function testParamIsCharacterToActionShow()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'lessons/abcd');

        $this->assertEquals(404, $resp->getStatusCode());
    }

    public function testParamsAreStringAndNumberToActionShow()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'lessons/1abcd');

        $this->assertEquals(404, $resp->getStatusCode());
    }

    public function testReponseDataInActionShow()
    {
        Auth::loginUsingId(1);
        $lessonFromDB = Lesson::find(1);
        $resp = $this->call('GET', 'lessons/1');
        $lessonResponse = $resp->original->getData()['lesson'];

        $this->assertInstanceOf('App\Lesson', $lessonResponse);
        $this->assertEquals($lessonFromDB->name, $lessonResponse->name);
    }

    public function testMissParamToActionResult()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'lessons/result');

        $this->assertEquals(404, $resp->getStatusCode());
    }

    public function testParamIsCharacterToActionResult()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'lessons/ABCD/result');

        $this->assertEquals(404, $resp->getStatusCode());
    }

    public function testParamsAreStringAndNumberToActionResult()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'lessons/12CD/result');

        $this->assertEquals(404, $resp->getStatusCode());
    }

    public function testResponseDataInActionResult()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'lessons/1/result');

        $this->assertViewHas('lesson_words');
    }

    public function testMissFourParamsToActionAnswer()
    {
        Auth::loginUsingId(1);

        $resp = $this->call('POST', 'lessons/answer');
        $errors = $resp->getData()->errors;

        $this->assertEquals(422, $resp->getStatusCode());
        $this->assertCount(4, $errors);
    }

    public function testReponseDataInActionAnswer()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('POST', 'lessons/answer',
            ['lesson_id' => 1, 'word_id' => 1, 'word_answer_id' => 1, 'cur_word' => 1]
        );
        $data = $resp->getData();

        $this->assertEquals(200, $resp->getStatusCode());
        $this->assertObjectHasAttribute('msg', $data);
    }
}
