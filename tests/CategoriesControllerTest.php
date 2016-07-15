<?php

use App\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class CategoriesControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testIfUserNotLogin()
    {
        $resp = $this->call('GET', '/categories/1');

        $this->assertEquals(302, $resp->getStatusCode());
        $this->assertTrue($resp->isRedirect($this->baseUrl . '/login'));
    }

    public function testGetAllCategories()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', '/categories');

        $this->assertEquals(200, $resp->getStatusCode());
        $this->assertViewHas('categories');
    }

    public function testParamIsStringToActionShow()
    {
        Auth::loginUsingId(1);
        $resp = $this->call('GET', 'categories/abcd');
        $view = $resp->original->getName();

        $this->assertEquals('errors.404', $view);
    }

    public function testResponseDataInActionShow()
    {
        Auth::loginUsingId(1);
        $cateFromDB = Category::find(1);
        $resp = $this->call('GET', 'categories/1');
        $cateResponse = $resp->original->getData()['category'];

        $this->assertInstanceOf('App\Category', $cateResponse);
        $this->assertEquals($cateFromDB->name, $cateResponse->name);
    }
}
