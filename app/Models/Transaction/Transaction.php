<?php

namespace App\Models\Transaction;

class Transaction extends \App\Models\ParentModel
{
    use \App\Models\Transaction\Traits\TransactionRelation;

    protected $table = "transactions";

    protected $casts = [
        'total' => 'float'
    ];

    /**
     * Add Transaction
     *
     * @param  \Illuminate\Http\Request  $transactionRequest
     * @return bool
     */
    public function addTransaction(array $transactionRequest): bool
    {

        if ($this->is_first) {

            $transactionRequest['is_first'] = false;

            $this->update($transactionRequest);

            return true;
        }

        $transactionRequest['transactionable_type'] = $this->transactionable_type;

        $transactionRequest['transactionable_id'] = $this->transactionable_id;

        // Create Transaction
        $this->create($transactionRequest);

        return true;
    }

    /**
     * Update Transaction
     *
     * @param  \Illuminate\Http\Request  $transactionRequest
     * @return bool
     */
    public function updateTransaction(array $transactionRequest, $transactionId): bool
    {
        if (!empty($transaction = $this->where('id', $transactionId)->first())) {

            // Update Transaction
            $transaction->update($transactionRequest);

            return true;
        }

        return false;
    }

    /**
     * Delete Transaction
     *
     * @param  int
     * @return bool
     */
    public function deleteTransaction($id): bool
    {
        if (!empty($transaction = $this->where('id', $id)->first())) {

            $transaction->delete();

            return true;
        }

        return false;
    }
}
