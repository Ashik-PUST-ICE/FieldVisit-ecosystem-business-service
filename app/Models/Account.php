<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function centralAccount()
    {
        return $this->belongsTo(CentralAccount::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

 

}
