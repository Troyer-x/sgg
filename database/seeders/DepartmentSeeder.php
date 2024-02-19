<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        
        $department1 = Department::create(['name' => 'Department 1']);
        $department2 = Department::create(['name' => 'Department 2']);
        $department3 = Department::create(['name' => 'Department 3']);

        $subdepartment1 = Department::create(['name' => 'Subdepartment 1']);
        $subdepartment1->parent()->associate($department1)->save();
    }
}