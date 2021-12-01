<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order\Request\OrderRequest;

class OrderController extends \App\Http\Controllers\Controller
{
    public function __construct(\App\Models\Order\Order $order)
    {
        $this->model = $order;
    }

    public function index()
    {
        $orders = $this->model;

        $orders = $orders->paginate($this->per_page());

        return $this->respondSuccess([
            'orders' => $orders,
            'pagination' => $this->pagination($orders)
        ]);
    }

    public function show($id)
    {
        if (!$order = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        return $this->respondSuccess([

            'order' => $order

        ]);
    }

    public function store(OrderRequest $request)
    {
        $this->model->create($request->validated());

        return $this->respondStored([]);
    }

    public function update(OrderRequest $request, $id)
    {
        if (!$order = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        $order->update($request->validated());

        return $this->respondUpdated([]);
    }

    public function destroy($id)
    {
        if (!$order = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        $order->delete();

        return $this->respondDeleted();
    }
}
