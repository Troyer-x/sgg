<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Department;
use App\Models\User;

class DepartmentUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_attach_a_user_to_a_department()
    {

        $department = Department::factory()->create();
        $user = User::factory()->create();

        $response = $this->post("/departments/{$department->id}/users", ['user_id' => $user->id]); //Add user to department

        $response->assertStatus(302); //Check redirect

        //Check if user is correctly added to department
        $this->assertDatabaseHas('department_user', [
            'department_id' => $department->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_can_detach_a_user_from_a_department()
    {

        $department = Department::factory()->create();
        $user = User::factory()->create();

        //Attach user to department
        $department->users()->attach($user->id);

        //Check if user is correctly added to department
        $this->assertDatabaseHas('department_user', [
            'department_id' => $department->id,
            'user_id' => $user->id,
        ]);

        //Detach user from department
        $response = $this->delete("/departments/{$department->id}/users/{$user->id}");

        //Check redirect
        $response->assertStatus(302);

        //Check if user is correctly removed from department
        $this->assertDatabaseMissing('department_user', [
            'department_id' => $department->id,
            'user_id' => $user->id,
        ]);
    }
}
