<?php

namespace App\Models;

use App\Enums\Commons\LeaveRequests\LeaveRequestsEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'days' => 'decimal:2',
        'applied_at' => 'datetime',
        'approved_at' => 'datetime',
        'accepted_at' => 'datetime',
        'status' => LeaveRequestsEnum::class,
    ];

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', LeaveRequestsEnum::APPROVED);
    }
}
