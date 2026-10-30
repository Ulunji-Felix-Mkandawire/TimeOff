<?php

namespace Database\Factories;

use App\LeaveStatus;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-3 months', '+2 months');

        // copy start date, and modify the value that starts with '+'
        $end = (clone $start)->modify('+'.fake()->numberBetween(0, 4).'days');

        return [
            'employee_id' => Employee::factory(),
            'leave_type_id' => LeaveType::factory(),
            'start_date' => $start,
            'end_date' => $end,
            'status' => LeaveStatus::Pending,
            'reason' => fake()->optional(0.5)->sentence(),
        ];
    }
}
