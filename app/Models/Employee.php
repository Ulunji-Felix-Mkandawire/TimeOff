<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'department_id',
        'manager_id'
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

    // Define self hasMany relationship for direct approach
    public function  directReports(): HasMany
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }
}
