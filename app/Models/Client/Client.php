<?php

namespace App\Models\Client;

use App\Models\ParentModel;
use App\Models\Client\Traits\ClientRelation;
use App\Models\Transaction\Traits\HasTransaction;

class Client extends ParentModel
{
    use ClientRelation, HasTransaction;

    protected $table = "clients";
}
