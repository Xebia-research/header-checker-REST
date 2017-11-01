<?php

abstract class ApiTestCase extends TestCase
{
    /**
     * @var \App\Application
     */
    protected $application;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->application = factory(App\Application::class)->create();
    }
}
