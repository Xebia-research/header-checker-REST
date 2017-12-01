<?php

use App\Profile;
use App\Application;

abstract class ApiTestCase extends TestCase
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * @var Profile
     */
    protected $profile;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->application = factory(App\Application::class)->create();
        $this->profile = factory(App\Profile::class)->create();
    }
}
