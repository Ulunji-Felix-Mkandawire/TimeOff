<?php

namespace Database\Seeders;

use App\LeaveStatus;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
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
            'Human Resources',
            'Sales',
            'Operations',
        ])->map(fn ($name) => Department::create([
            'name' => $name,
        ]));

        // Assign ids of the 5 created departments to the department_id column on the employees_table
        // Store the first 5 rows of the employees_table with assigned department_id in managers array

        $managers = $departments->map(fn ($department) => Employee::factory()->create([
            'department_id' => $department->id,
        ]));

        // Create 5 employees per department and assign managers

        foreach ($departments as $i => $department) {
            Employee::factory()->count(5)->create([
                'department_id' => $department->id,
                // manager[$i] = employee id whose id matches the current index
                // The employees who are managers have null on their manager column
                // Because at the point of creation, there's no employee whose id matches the index
                'manager_id' => $managers[$i]->id,
            ]);
        }

        // Leave Types

        // Create a collection with literal leave type data
        // Map the collection and assign create/save to database each type instance
        $leaveTypes = collect([
            ['name' => 'Annual', 'default_days_per_year' => 21],
            ['name' => 'Sick', 'default_days_per_year' => 10],
            ['name' => 'Study', 'default_days_per_year' => 5],
        ])->map(fn ($type) => LeaveType::create($type));

        // Create between 1 - 3 Requests for each employee
        foreach (Employee::all() as $employee) {
            // decide range between 1- 3 for each current employee instance
            foreach (range(1, fake()->randomNumber(1, 3)) as $i) {
                // Check if the employee has a manager id
                // Assign random leave status to employees with manager id
                // Employees without manager id, should have status as Pending

                $status = $employee->manager_id ? fake()->randomElement(LeaveStatus::cases()) : LeaveStatus::Pending;

                // Determine if the status is either rejected or approved by comparing it to the default
                // Returns true or false

                $decided = $status !== LeaveStatus::Pending;

                // Create the Leave Request
                LeaveRequest::factory()->create([
                    'employee_id' => $employee->id,
                    'leave_type_id' => $leaveTypes->random()->id,
                    'status' => $status,
                    'decided_by' => $decided ? $employee->manager_id : null,
                    'decided_at' => $decided ? now() : null,
                ]);
            }
        }

        // Seed balances

        // Set year to current year
        $year = now()->year;

        // Assign each employee default leave balance

        foreach (Employee::all() as $employee) {
            // Get all leave types from the leaveTypes collection defined above
            foreach ($leaveTypes as $type) {
                // Assign the three leave types to each employee instance
                $employee->leaveTypes()->attach($type->id, [
                    'year' => $year,
                    'days_allowed' => $type->default_days_per_year,
                ]);
            }
        }

    }
}
