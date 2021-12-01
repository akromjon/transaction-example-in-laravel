<?php

namespace App\Models\Transaction\Traits;

use App\Models\Transaction\Transaction;

trait HasTransaction
{

    public function hasTransaction()
    {

        if (!$this->callTransactionRelation()->exists()) {

            $this->callTransactionRelation()->create([
                'is_first' => true,
                'total'=>0
            ]);
        }

        return $this->callTransactionRelation();
    }

    public function callTransactionRelation(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return  $this->morphOne(Transaction::class, 'transactionable');
    }

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    public function transactions()
    {

        return $this->morphMany(Transaction::class, 'transactionable')->orderBy('id', 'DESC');
    }
}
