<?php
namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class LoginTest extends TestCase
{
    use DatabaseTransactions;
	
    /*
    |--------------------------------------------------------------------------
    | The login form can be displayed.
    |--------------------------------------------------------------------------
    |
    | @return void
    */
    public function testLoginUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
	
    /*
    |--------------------------------------------------------------------------
    | Avoid Login from invalid user.
    |--------------------------------------------------------------------------
    |
    | @return void
    */
    public function loginInvalidUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
	
    /*
    |--------------------------------------------------------------------------
    | Test logout.
    |--------------------------------------------------------------------------
    |
    | @return void
    */
    public function testLogout()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }
}