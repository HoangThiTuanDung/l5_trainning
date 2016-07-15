<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class WordsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testIfUserNotLogin()
    {
        $resp = $this->call('GET', '/words/search');
        
        $this->assertEquals(302, $resp->getStatusCode());
        $this->assertTrue($resp->isRedirect($this->baseUrl . '/login'));
    }

    public function testMissTwoParamsToActionSearch()
    {
        Auth::loginUsingId(1);

        $resp = $this->call('GET', '/words/search');
        $errors = $resp->getData()->errors;
    
        $this->assertEquals(422, $resp->getStatusCode());
        $this->assertCount(2, $errors);
    }

    public function testMissParamCateToActionSearch()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', '/words/search', ['flag' => 1]);
        $errors = $resp->getData()->errors;

        $this->assertContains('The category id field is required.', $errors);        
    }

    public function testMissParamFlagToActionSearch()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', '/words/search', ['category_id' => 1]);
        $errors = $resp->getData()->errors;

        $this->assertContains('The flag field is required.', $errors);
    }

    public function testParamsAreStringToActionSearch()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', '/words/search', ['category_id' => 'category', 'flag' => 'flag']);
        
        $errors = $resp->getData()->errors;
        
        $this->assertContains('The category id must be an integer.', $errors);
        $this->assertContains('The flag must be an integer.', $errors);
    }

    public function testReponseDataInActionSearch()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', '/words/search', ['category_id' => 1, 'flag' => 1]);
        $data = $resp->getData();

        $this->assertEquals(200, $resp->getStatusCode());
        $this->assertObjectHasAttribute('results', $data);
    }

    public function testParamIsCharToActionShow()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'words/aaaa');
        $view = $resp->original->getName();

        $this->assertEquals('errors.404', $view);
    }

    public function testParamAreStringAndNumberToActionShow()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'words/11aaaa');

        $view = $resp->original->getName();

        $this->assertEquals('errors.404', $view);
    }

    public function testResponseDataInActionShow()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'words/1');
        $word = $resp->original->getData()['word'];

        $this->assertInstanceOf('App\Word', $word);
        $this->assertViewHas('word');
    }
}
