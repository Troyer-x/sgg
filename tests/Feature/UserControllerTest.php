<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_all_users()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertSeeText('User management'); //Check if the page has the text "Manage users"
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->put("/users/{$user->id}", ['name' => 'Updated user', 'email' => 'test@test.com', 'password' => bcrypt('kkk'), // Hashear la contraseña antes de almacenarla
    ]);

        $response->assertStatus(302); //Refirect success
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated user', 'email' => 'test@test.com']); //Check if the user was updated

    }
    
    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/users/{$user->id}");

        $response->assertStatus(302); //Refirect success
        $this->assertDatabaseMissing('users', ['id' => $user->id]); //Check if the user was deleted
    }
}