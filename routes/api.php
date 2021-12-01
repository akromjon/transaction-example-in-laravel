<?php

use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/clients', ClientController::class);

Route::apiResource('/orders', OrderController::class);

Route::apiResource('/transactions', TransactionController::class)->only('index', 'show');
Route::post('create_transaction/{clientId}', [TransactionController::class, 'store']);
Route::put('update_transaction/{clientId}/{transactionId}', [TransactionController::class, 'update']);
Route::delete('delete_transaction/{clientId}/{transactionId}', [TransactionController::class, 'destroy']);
