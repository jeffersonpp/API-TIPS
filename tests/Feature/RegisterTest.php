<?php

namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class RegisterTest extends TestCase
{

    use HybridRelations;

    /*
    |--------------------------------------------------------------------------
    | Register a valid user.
    |--------------------------------------------------------------------------
    */
    public function testRegister()
    {
        $user = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticated();
    }
	
    /*
    |--------------------------------------------------------------------------
    | Avoid register an invalid user.
    |--------------------------------------------------------------------------
     */
    public function testDoesNotRegisterAnInvalidUser()
    {
        $user = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}

?>