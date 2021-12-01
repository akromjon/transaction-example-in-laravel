<?php

namespace App\Http\Controllers\Api\Transaction;

use Illuminate\Support\Facades\DB;
use App\Models\Transaction\Request\TransactionRequest;

class TransactionController extends \App\Http\Controllers\Controller
{
    public function __construct(\App\Models\Transaction\Transaction $transaction, \App\Models\Client\Client $client)
    {
        $this->model = $transaction;

        $this->client = $client;
    }

    public function index()
    {
        $transactions = $this->model->with(['order']);

        $transactions = $transactions->paginate($this->per_page());

        return $this->respondSuccess([
            'transactions' => $transactions,
            'pagination' => $this->pagination($transactions)
        ]);
    }

    public function show($id)
    {
        if (!$transaction = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        return $this->respondSuccess([

            'transaction' => $transaction

        ]);
    }

    public function store(TransactionRequest $request, $clientId)
    {
        $request = $request->validated();

        if (!$client = $this->client->find($clientId)) {

            return $this->respondNotFound(__('message.client_not_found'));
        }

        try {

            DB::transaction(function () use ($client, $request) {

                $client->hasTransaction->addTransaction($request);
            });

            DB::commit();
        } catch (\Throwable $e) {

            DB::rollback();

            return $this->respondBadRequest($e->getMessage());
        }

        return $this->respondStored([]);
    }

    public function update(TransactionRequest $request, $clientId, $transactionId)
    {
        $request = $request->validated();

        if (!$client = $this->client->find($clientId)) {

            return $this->respondNotFound(__('message.client_not_found'));
        }

        try {

            DB::transaction(function () use ($client, $request, $transactionId) {

                $client->hasTransaction->updateTransaction($request, $transactionId);
            });

            DB::commit();
        } catch (\Throwable $e) {

            DB::rollback();

            return $this->respondBadRequest($e->getMessage());
        }

        return $this->respondUpdated([]);
    }

    public function destroy($clientId, $transactionId)
    {
        if (!$client = $this->client->find($clientId)) {

            return $this->respondNotFound();
        }

        $client->hasTransaction->deleteTransaction($transactionId);

        return $this->respondDeleted();
    }
}
