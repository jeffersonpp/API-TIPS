<?php
namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class ResetsPasswordTest extends TestCase
{
    use HybridRelations;
	
    /*
    |--------------------------------------------------------------------------
    | Test the password reset email.
    |--------------------------------------------------------------------------
    */
    public function testSendsPasswordResetEmail()
    {
        $user = factory(User::class)->create();
        $this->expectsNotification($user, ResetPassword::class);
        $response = $this->post('password/email', ['email' => $user->email]);
        $response->assertStatus(302);
    }
	
    /*
    |--------------------------------------------------------------------------
    | Does not send a password reset email when the user does not exist.
    |--------------------------------------------------------------------------
    */
    public function testDoesNotSendPasswordResetEmail()
    {
        $this->doesntExpectJobs(ResetPassword::class);
        $this->post('password/email', ['email' => 'notexist@email.com']);
    }

    /*
    |--------------------------------------------------------------------------
    | Allows reset password.
    |--------------------------------------------------------------------------
    */
    public function testChangesAUsersPassword()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);
        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}