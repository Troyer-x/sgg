<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Department;

class DepartmentControllerTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_all_departments()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
        $response->assertSeeText('Manage Departments'); //Check if the page has the text "Manage Departments"
    }

    /** @test */
    public function it_can_update_a_department()
    {
        $department = Department::factory()->create();

        $response = $this->put("/departments/{$department->id}", ['name' => 'Updated Department']);

        $response->assertStatus(302); //Refirect success
        $this->assertDatabaseHas('departments', ['id' => $department->id, 'name' => 'Updated Department']); //Check if the department was updated

    }
    
    /** @test */
    public function it_can_delete_a_department()
    {
        $department = Department::factory()->create();

        $response = $this->delete("/departments/{$department->id}");

        $response->assertStatus(302); //Refirect success
        $this->assertDatabaseMissing('departments', ['id' => $department->id]); //Check if the department was deleted
    }
}