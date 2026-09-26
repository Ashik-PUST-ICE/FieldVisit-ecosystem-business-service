<?php

namespace App\Models;

use App\Enums\Commons\LeaveApprovals\LeaveApprovalsEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApproval extends Model
{
    protected $guarded = [];

    public function leaveRequest(): BelongsTo
    {
        return $this->belongsTo(LeaveRequest::class);
    }

    protected $casts = [

        'action' => LeaveApprovalsEnum::class,
        'action_at' => 'datetime',
    ];

    public function scopeApproved($query)
    {
        return $query->where('action', LeaveApprovalsEnum::APPROVED);
    }
}
