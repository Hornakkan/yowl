<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions; // remettre la BDD comme elle était


class CommentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_comments()
    {
        $response = $this->getJson('/api/reviews/59/comments');
 
        $response
            ->assertStatus(200) // statut 200 = réussi !
            ->assertJsonStructure([
                [
                    'id',
                    'author_id',
                    'review_id',
                    'content',
                    'created_at',
                    'updated_at'
                ]
            ]); 
    }

    public function test_get_one_comment()
    {
        $response = $this->getJson('/api/reviews/59/comments/24');
 
        $response
            ->assertStatus(200) // statut 200 = réussi !
            ->assertJsonStructure([
                'id',
                'author_id',
                'review_id',
                'content',
                'created_at',
                'updated_at'
            ]); 
    }

    public function test_get_one_bad_number_comment()
    {
        $response = $this->getJson('/api/reviews/59/comments/4242424242');
 
        $response
            ->assertStatus(404); //test 404 = not found! 
    }

    public function test_get_one_bad_string_comment()
    {
        $response = $this->getJson('/api/reviews/59/comments/bonjour');
 
        $response
            ->assertStatus(404); //test 404 = not found! 
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
    public function test_creating_one_comment()
    {
        $user = $this->fake_login();
        $response = $this->postJson('/api/reviews/59/comments', [
            "author_id" => 3,
            "content"=> "test zarbi"
        ]);
 
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'author_id',
                'review_id',
                'content',
                'created_at',
                'updated_at'
            ]);
        $this->fake_logout($user);
    }

    public function test_creating_one_comment_no_author()
    {
        $user = $this->fake_login();
        $response = $this->postJson('/api/reviews/59/comments', [
            "content"=> "test zarbi"
        ]);
 
        $response
            ->assertStatus(422) // 422 : les instructions "required" ne sont pas trouvées par le serveur
            ->assertJson([
                "message" => "The author id field is required."
            ]);
            $this->fake_logout($user);
    }

    public function test_creating_one_comment_no_content()
    {
        $user = $this->fake_login();
        $response = $this->postJson('/api/reviews/59/comments', [
            "author_id" => 3,
        ]);
 
        $response
            ->assertStatus(422) // 422 : les instructions "required" ne sont pas trouvées par le serveur
            ->assertJson([
                "message" => "The content field is required."
            ]);
            $this->fake_logout($user);
    }

    public function test_creating_one_comment_no_body()
    {
        $user = $this->fake_login();
        $response = $this->postJson('/api/reviews/59/comments');
 
        $response->assertStatus(422); // 422 : les instructions "required" ne sont pas trouvées par le serveur
        $this->fake_logout($user);
    }

    public function test_creating_one_comment_author_not_int()
    {
        $user = $this->fake_login();
        $response = $this->postJson('/api/reviews/59/comments', [
            "author_id" => "hohoho",
            "content"=> "test zarbi"
        ]);
 
        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "The author id must be an integer."
            ]);
        $this->fake_logout($user);
    }
    // TODO: ajouter un test qui vérifie que l'auteur existe dans test de commentaires

    public function test_updating_one_comment()
    {
        $user = $this->fake_login();
        $response = $this->putJson('/api/reviews/59/comments/24', [
            "author_id" => 3,
            "content"=> "test 43"
        ]);
 
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success'=> true
            ]);
    
        $response = $this->getJson('/api/reviews/59/comments/24');

        $response
            ->assertStatus(200) // statut 200 = réussi !
            ->assertJson([
                'author_id' => 3,
                'content' => "test 43",
            ]); 
        $this->fake_logout($user);
    }

    public function test_updating_one_comment_no_author()
    {
        $user = $this->fake_login();
        $response = $this->putJson('/api/reviews/59/comments/24', [
            "content"=> "test zarbi"
        ]);
 
        $response
            ->assertStatus(422) // 422 : les instructions "required" ne sont pas trouvées par le serveur
            ->assertJson([
                "message" => "The author id field is required."
            ]);
        $this->fake_logout($user);
    }

    public function test_updating_one_comment_no_content()
    {
        $user = $this->fake_login();
        $response = $this->putJson('/api/reviews/59/comments/24', [
            "author_id" => 3,
        ]);
 
        $response
            ->assertStatus(422) // 422 : les instructions "required" ne sont pas trouvées par le serveur
            ->assertJson([
                "message" => "The content field is required."
            ]);
        $this->fake_logout($user);
    }

    public function test_updating_one_comment_no_body()
    {
        $user = $this->fake_login();
        $response = $this->putJson('/api/reviews/59/comments/24');
 
        $response->assertStatus(422); // 422 : les instructions "required" ne sont pas trouvées par le serveur
        $this->fake_logout($user);
    }

    public function test_updating_one_comment_author_not_int()
    {
        $user = $this->fake_login();
        $response = $this->putJson('/api/reviews/59/comments/24', [
            "author_id" => "hohoho",
            "content"=> "test zarbi"
        ]);
 
        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "The author id must be an integer."
            ]);
        $this->fake_logout($user);
    }
    // TODO: ajouter un test qui vérifie que l'auteur existe dans test de commentaires

    public function test_deleting_one_comment()
    {
        $user = $this->fake_login();
        $response = $this->deleteJson('/api/reviews/59/comments/24');
 
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success'=> true
            ]);
        $this->fake_logout($user);
    }

    public function test_deleting_one_comment_twice()
    {
        $user = $this->fake_login();
        $response = $this->deleteJson('/api/reviews/59/comments/24');
 
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success'=> true
            ]);
        $response = $this->deleteJson('/api/reviews/59/comments/24');
        $response->assertStatus(404);
        $this->fake_logout($user);
    }

    public function test_deleting_one_bad_comment()
    {
        $user = $this->fake_login();
        $response = $this->deleteJson('/api/reviews/59/comments/22222');
 
        $response->assertStatus(404);
        $this->fake_logout($user);
    }
}
