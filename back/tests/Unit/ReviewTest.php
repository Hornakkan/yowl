<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions; // remettre la BDD comme elle était


class ReviewTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_reviews()
    {
        $response = $this->getJson('/api/reviews/');
 
        $response
            ->assertStatus(200) // statut 200 = réussi !
            ->assertJsonStructure([
                [
                    "id",
                    "title",
                    "game_id",
                    "picture",
                    "content",
                    "author_id",
                    "review_rank",
                    "created_at",
                    "updated_at"
                ]
            ]); 
    }

    public function test_get_one_review()
    {
        $response = $this->getJson('/api/reviews/55');
 
        $response
            ->assertStatus(200) // statut 200 = réussi !
            ->assertJsonStructure([
                "id",
                "title",
                "game_id",
                "picture",
                "content",
                "author_id",
                "review_rank",
                "created_at",
                "updated_at"
            ]); 
    }

    public function fake_login() {
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
        return $user;
    }
    public function fake_logout($user) {
        if($user) {
            $user->delete();
        }
    }
    public function test_creating_one_review()
    {
        $user = $this->fake_login();
        $response = $this->postJson('/api/reviews', [
            "title"=>"Amazing game",
            "game_id"=>2,
            "picture"=>"fausseimage.jpg",
            "content"=>"wow incroyable jeu!!!",
            "author_id"=>$user->id,
            "review_rank"=>5,
        ]);
 
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                "id",
                "title",
                "game_id",
                "picture",
                "content",
                "author_id",
                "review_rank",
                "created_at",
                "updated_at"
            ]);
        $this->fake_logout($user);
    }

    public function test_updating_one_review()
    {
        $user = $this->fake_login();
        $response = $this->putJson('/api/reviews/55', [
            "content"=> "test 43",
            "title"=>"nouveau titre"
        ]);
 
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success'=> true
            ]);
    
        $response = $this->getJson('/api/reviews/55');

        $response
            ->assertStatus(200) // statut 200 = réussi !
            ->assertJson([
                'content' => "test 43",
                "title"=>"nouveau titre"
            ]); 
        $this->fake_logout($user);
    }

    public function test_deleting_one_review()
    {
        $user = $this->fake_login();
        $response = $this->deleteJson('/api/reviews/61');
 
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success'=> true
            ]);
        $this->fake_logout($user);
    }
}
