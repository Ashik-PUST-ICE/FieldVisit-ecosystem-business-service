<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeavePolicy extends Model
{
    protected $guarded = [];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
