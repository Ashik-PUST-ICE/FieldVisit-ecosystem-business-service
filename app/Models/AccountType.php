<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
