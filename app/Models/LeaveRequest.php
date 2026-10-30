<?php

namespace App\Models;

use App\LeaveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'status',
        'reason',
        'decided_by',
        'decided_at',
    ];

    protected function casts()
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => LeaveStatus::class,
            'decided_at' => 'datetime',
        ];
    }


    // One employee has many requests: Annual, pto, etc
    // Therefore many requests (of same or various types) belongs to an employee
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    // One leave type has many request from different employee
    // Therefore each request belongs to at least one kind of leave (pto, annual, sick)
    public function leaveType(): BelongsTo
    {
        return $this->belongdTo(LeaveType::class);
    }

    // Manager has many requests to decide
    // Each request belongs to a manager, who also already has other requests
    public function decidedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'decided_by');
    }
}
