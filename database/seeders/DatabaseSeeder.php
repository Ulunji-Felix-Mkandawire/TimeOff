<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create a collection with real department names 
        // Map and assign each department name from collection to the 'name' column on departments table
        // by calling the Department::create([])

        $departments = collect([
            'Engineering',
            'Finance',
            'Human Resource',
            'Sales',
            'Operations'
        ])->map( fn($name) => Department::create([
            'name' => $name
        ]));


        // Assign ids of the 5 created departments to the department_id column on the employees_table
        // Store the first 5 rows of the employees_table with assigned department_id in managers array

        $managers = $departments->map( fn($department) => Employee::factory()->create([
            'department_id' => $department->id
        ]) );

        // Create 5 employees per department and assign managers

        foreach( $departments as $i => $department ){
            Employee::factory()->count(5)->create([
                'department_id' => $department->id,
                // manager[$i] = employee id whose id matches the current index
                'manager_id' => $managers[$i]->id
            ]);
        }
        
    }
}
