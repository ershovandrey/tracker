<?php

namespace Tests\Feature;

use App\Site;
use function factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SitesTest extends TestCase {
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_create_a_site() {
        // Given I am a user who is a logged in.
        $this->actingAs(factory('App\User')->create());

        // When I hit the endpoint /sites to create a new site and pass the required data
        $url = $this->faker()->url;
        $this->post('/sites', [
            'title' => $this->faker()->realText(20),
            'url' => $url,
        ]);

        // Then there should be a new site created in the database
        $this->assertDatabaseHas('sites', ['url' => $url]);
    }

    /** @test */
    public function a_user_can_delete_the_site()
    {
        // Given I am a user who is a logged in.
        $this->actingAs(factory('App\User')->create());
        // And I have a site created.
        $site = factory('App\Site')->create(['user_id' => auth()->id()]);
        $this->assertTrue($site instanceof Site, 'User has own site created');

        // When I hit the endpoint /sites/{id} to delete a site
        $this->delete('/sites/' . $site->id);

        // Then there should be no site with given URL in the database
        $this->assertDatabaseMissing('sites', ['url' => $site->url]);
    }
}
