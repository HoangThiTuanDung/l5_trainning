<?php
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected function setUp()
    {
        parent::setUp();
        Artisan::call('migrate', array('--database' => 'testing'));
        Artisan::call('db:seed', array('--database' => 'testing'));
    }
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset', array('--database' => 'testing'));
        parent::tearDown();
    }
}
