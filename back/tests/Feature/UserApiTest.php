<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
 
    public function test_user_can_register() {
        $formData = [
            'name' => 'user api test',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'admin' => 0,
            'birthdate' => ''
        ];
        
        $this->post('/api/register', $formData)->assertStatus(201);

        $user = User::where('email', 'userapitest@userapitest.com')->first();

        if($user) {
            $user->delete();
        }
    }

    public function test_user_can_not_register_with_already_registered_email() {
        $formData1 = [
            'name' => 'user api test 1',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test123456',
            'password_confirmation' => 'test123456',
            'admin' => 0,
            'birthdate' => ''
        ];

        $formData2 = [
            'name' => 'user api test 2',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test123456',
            'password_confirmation' => 'test123456',
            'admin' => 0,
            'birthdate' => ''
        ];
        $this->post('/api/register', $formData1);
        $this->post('/api/register', $formData2)->assertSessionHasErrors('email');

        $user = User::where('email', 'userapitest@userapitest.com')->first();
        if($user) {
            $user->delete();
        }   
    }

    public function test_user_can_login() {
        $formData = [
            'name' => 'user api test',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'admin' => 0,
            'birthdate' => ''
        ];
        
        $this->post('/api/register', $formData)->assertStatus(201);

        $user = User::where('email', 'userapitest@userapitest.com')->first();
    
        $loginData = [
            'email' => 'userapitest@userapitest.com',
            'password' => 'test'
        ];
        
        $this->post('/api/login', $loginData)->assertStatus(200);

        if($user) {
            $user->delete();
        }    
    }

    public function test_user_can_logout() {
        $formData = [
            'name' => 'user api test',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'admin' => 0,
            'birthdate' => ''
        ];
        
        $this->post('/api/register', $formData);

        $user = User::where('email', 'userapitest@userapitest.com')->first();

        $response = $this->actingAs($user, 'sanctum');

        $response->post('api/logout')->assertStatus(200);

        if($user) {
            $user->delete();
        }    
    }


    public function test_user_can_update_its_profile() {
        $formData = [
            'name' => 'user api test',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'admin' => 0,
            'birthdate' => ''
        ];
        
        $this->post('/api/register', $formData);

        $user = User::where('email', 'userapitest@userapitest.com')->first();

        $response = $this->actingAs($user, 'sanctum');
        $route = 'api/users/'.$user->id;

        $data = [
            'name' => 'User Api Test'
        ];

        $response->put($route, $data)->assertStatus(200);

        if($user) {
            $user->delete();
        }    
    }    

    public function test_user_can_not_update_other_users_profile() {
        $formData = [
            'name' => 'user api test',
            'email' => 'userapitest@userapitest.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'admin' => 0,
            'birthdate' => ''
        ];
        
        $this->post('/api/register', $formData);

        $user = User::where('email', 'userapitest@userapitest.com')->first();

        $response = $this->actingAs($user, 'sanctum');
        $route = 'api/users/2';

        $data = [
            'name' => 'User Api Test'
        ];

        $response->put($route, $data)->assertStatus(401);

        if($user) {
            $user->delete();
        }    
    }      
    
}
