<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;


class UserRegistrationTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * A registration page can be displaysed.
     *
     */
    
     public function test_registeration_page_displayed()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * A valid user can be registered.
     *
     */
    public function test_valid_user_can_register()
    {
        $user = User::factory()->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);


        $this->assertAuthenticated();
    }
    
    /**
     * An invalid user can not be registered.
     *
     */

    public function test_invalid_user_can_not_be_registered()
    {
        $user = User::factory()->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }
}
