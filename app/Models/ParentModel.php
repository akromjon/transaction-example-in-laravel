<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use  \Illuminate\Database\Eloquent\SoftDeletes;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
