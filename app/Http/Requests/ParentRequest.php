<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParentRequest extends FormRequest
{


    protected function send_errors($validator_errors)
    {
        $errors = (new ValidationException($validator_errors))->errors();
        return $this->sendError($errors, __('messages.validation_error'));
    }

    protected function sendError($validator_errors, $message = '')
    {
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
