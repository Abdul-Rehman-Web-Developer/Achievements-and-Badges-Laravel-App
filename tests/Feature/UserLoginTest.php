<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * A login page can be displaysed.
     *
     */
    
    public function test_login_page_displayed()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * A valid user can login.
     *
     */
    public function test_valid_user_can_login()
    {

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '1234'
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

      /**
     * An invalid user can login.
     *
     */
    public function test_invalid_user_can_not_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    /**
     * A logged in user can be logged out.
     *
     */
    public function test_logout_authenticated_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);

        $this->assertGuest();
    }
}
