<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PasswordResetTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A forgot password page can be displaysed.
     *
     */

    public function test_forgot_password_page_displayed()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }


    /**
     * Sends the password reset email when the user exists.
     *
     */
    public function test_send_password_reset_email()
    {
        $user = User::factory()->create();

        $this->expectsNotification($user, ResetPassword::class);

        $response = $this->post('/forgot-password', ['email' => $user->email]);

        $response->assertStatus(302);
    }

     /**
     * Do not send a password reset email when the user does not exist.
     *
     */

    public function test_do_not_send_password_reset_email()
    {

        $this->doesntExpectJobs(ResetPassword::class);

        $this->post('/forgot-password', ['email' => 'invalid@email.com']);
    }

    /**
     * A reset password page can be displaysed.
     *
     */
    public function test_reset_password_page_displayed()
    {
        $response = $this->get('/reset-password/token');

        $response->assertStatus(200);
    }

     /**
     * Update user password.
     *
     */
    public function test_update_user_password()
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
