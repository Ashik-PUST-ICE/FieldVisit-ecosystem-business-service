<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionObserver
{
    public function creating(Transaction $transaction): void
    {
        if (empty($transaction->transaction_id)) {
            $transaction->transaction_id = $this->generateTransactionId();
        }
    }

    private function generateTransactionId(): string
    {
        do {
            $id = 'TXN-'.Str::random(10);
        } while (Transaction::where('transaction_id', $id)->exists());

        return $id;
    }
}
