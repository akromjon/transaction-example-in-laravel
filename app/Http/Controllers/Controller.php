<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponseTrait;

    protected $per_page;

    protected $model;

    public function per_page()
    {
        return request()->get('per_page', 10000);
    }

    public function pagination(object $object): array
    {
        return [
            'total' => $object->total(),
            'count' => $object->count(),
            'per_page' => $object->perPage(),
            'current_page' => $object->currentPage(),
            'total_pages' => $object->lastPage(),
            'last_page' => $object->lastPage()
        ];
    }
}
