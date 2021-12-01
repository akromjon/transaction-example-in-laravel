<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Client\Request\ClientRequest;

class ClientController extends \App\Http\Controllers\Controller
{
    public function __construct(\App\Models\Client\Client $client)
    {
        $this->model = $client;
    }

    public function index()
    {
        $clients = $this->model;

        $clients = $clients->paginate($this->per_page());

        return $this->respondSuccess([
            'clients' => $clients,
            'pagination' => $this->pagination($clients)
        ]);
    }

    public function show($id)
    {
        if (!$client = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        return $this->respondSuccess([

            'client' => $client

        ]);
    }

    public function store(ClientRequest $request)
    {
        $this->model->create($request->validated());

        return $this->respondStored([]);
    }

    public function update(ClientRequest $request, $id)
    {
        if (!$client = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        $client->update($request->validated());

        return $this->respondUpdated([]);
    }

    public function destroy($id)
    {
        if (!$client = $this->model->find($id)) {

            return $this->respondNotFound();
        }

        $client->delete();

        return $this->respondDeleted();
    }
}
