<?php

namespace App\Models\Transaction\Traits;

use App\Models\Order\Order;

trait TransactionRelation
{
    public function transactionable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
