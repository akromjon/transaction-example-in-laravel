<?php

namespace App\Models\Order;

use App\Models\ParentModel;

class Order extends ParentModel
{
    use \App\Models\Order\Traits\OrderRelation;

    protected $table = "orders";
}
