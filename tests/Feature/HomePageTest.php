<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * Test to ensure the Home Page loads successfully.
     */
    public function test_home_page_loads_successfully()
    {
        // Send GET request to Home Page URL "/"
        $response = $this->get('/');

        // Assert that response status is 200 OK
        $response->assertStatus(200);

        // Assert that page contains "Welcome"
        $response->assertSee("Welcome");
    }
}
