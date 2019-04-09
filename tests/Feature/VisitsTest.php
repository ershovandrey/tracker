<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function visit_on_site_is_tracked()
    {
        // Given site for tracking.
        $site = factory('App\Site')->create(['user_id' => factory('App\User')->create()->id]);
        $url = $this->faker()->url;

        // When posting visitor data to visit endpoint.
        $response = $this->postJson('/api/visit', [
            'token' => $site->token,
            'visitor' => $this->faker()->bankAccountNumber,
            'url' => $url,
            'browser' => $this->faker()->text(50),
        ]);

        // Then response code 201 returned.
        $response->assertStatus(201);

        // And new visit record exists.
        $this->assertDatabaseHas('visits', ['url' => $url]);
    }

    /** @test */
    public function visit_on_site_with_wrong_params_is_not_tracked()
    {
        // Given site for tracking.
        $site = factory('App\Site')->create(['user_id' => factory('App\User')->create()->id]);
        $url = $this->faker()->url;

        // When posting visitor data to visit endpoint with wrong token.
        $response = $this->postJson('/api/visit', [
            'token' => $site->token . '' . $this->faker()->randomDigit,
            'visitor' => $this->faker()->bankAccountNumber,
            'url' => $url,
            'browser' => $this->faker()->text(50),
        ]);

        // Then response code 404 returned.
        $response->assertStatus(404);

        // And new visit record is not exists.
        $this->assertDatabaseMissing('visits', ['url' => $url]);
    }
}
