<?php

namespace App\Models;

use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'department_id',
        'manager_id',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // Point to self and define belongs to manager relationsh
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    // Ma direct reports sima documents, ndi anthu.
    // So since multiple employees can share a manager, mpake tikuti manager x.. decided
    // by their is has many employees indicating that when we say that
    // manager->directReports()->all(), we'll get a list of all employees that report to him/her

    // now this method (directReports) is defined right within this model class because the manager
    // is also an employee but assuming if the manager had their own model class
    // we would've has this method on that model class instead

    // The second argue 'manager_id' tells laravel that the column it should look for when
    // establishing this relationship is manager_id not the employee_id which is the default case
    public function directReports(): HasMany
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function leaveTypes(): BelongsToMany
    {
        return $this->belongsToMany(LeaveType::class)
            ->withPivot(['year', 'days_allowed'])
            ->withTimestamps();
    }
}
