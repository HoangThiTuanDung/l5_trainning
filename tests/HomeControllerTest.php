<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testIfUserNotLogin()
    {
        $resp = $this->call('GET', '/home');
        
        $this->assertEquals(302, $resp->getStatusCode());
        $this->assertTrue($resp->isRedirect($this->baseUrl . '/login'));
    }

    public function testGetDataActionIndex()
    {
    	Auth::loginUsingId(1);
        
        $resp = $this->call('GET', '/home');

        $this->assertEquals(200, $resp->getStatusCode());
        $this->assertViewHas('activities');
    }
}
