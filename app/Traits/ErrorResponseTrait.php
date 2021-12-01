<?php


namespace App\Traits;


use Illuminate\Http\Exceptions\HttpResponseException;

trait ErrorResponseTrait
{

    protected function sendError($validator_errors, $message = ''){
        throw new HttpResponseException(
            response()->json([
                'result' => [
                    'success' => false,
                    'data'     => []
                ],
                'error' => [
                    'message' => $message,
                    'code'    => 422
                ],
                'validation_errors' => $validator_errors,
            ])->setStatusCode(422)
        );
    }
}
