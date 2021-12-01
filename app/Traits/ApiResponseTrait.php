<?php

namespace App\Traits;

trait ApiResponseTrait
{

    protected function name()
    {
        $class_path = get_class($this);

        $class = substr(strrchr($class_path, "\\"), 1);

        $convertToSmallLetters = strtolower($class);

        $name = str_replace('controller', '', $convertToSmallLetters);

        return __("messages.{$name}");
    }

    protected function respond($data, $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    protected function respondSuccess(array $data)
    {
        return $this->respond(
            [
                'result' => [
                    'success' => true,
                    'data'    => $data
                ]
            ]
        );
    }

    protected function respondStored(array $data, $message = null)
    {
        return $this->respond([
            'result' => [
                'success' => true,
                'message' => $message ? $message :  makeStoredMessage($this->name()),
                'data'    => $data
            ]
        ], 201);
    }

    protected function respondUpdated(array $data, $message =null)
    {
        return $this->respond([
            'result' => [
                'success' => true,
                'message' => $message ? $message :  makeUpdatedMessage($this->name()),
                'data'    => $data
            ]
        ], 201);
    }

    protected function respondDeleted($message = null)
    {
        return $this->respond([
            'result' => [
                'success' => true,
                'message' => $message ? $message :  makeDeletedMessage($this->name()),
                'data' => []
            ]
        ], 200);
    }

    protected function respondError($message, $statusCode)
    {
        return $this->respond(
            [
                'result' => [
                    'success' => false,
                    'data'    => []
                ],
                'error' => [
                    'message' => $message ? $message : makeNotFoundMessage($this->name()),
                    'code'    => $statusCode
                ]
            ],
            $statusCode
        );
    }
    protected function respondUnauthorized($message = 'unauthorized')
    {
        return $this->respondError($message, 401);
    }

    protected function respondNotFound($message = null)
    {
        return $this->respond(
            [
                'result' => [
                    'success' => false,
                    'data'    => []
                ],
                'error' => [
                    'message' => $message ? $message : makeNotFoundMessage($this->name()),
                    'code'    => 404
                ]
            ],
            404
        );
    }

    protected function respondBadRequest($message=null)
    {
        return $this->respond(
            [
                'result' => [
                    'success' => false,
                    'data'    => []
                ],
                'error' => [
                    'message' => $message ? $message : makeBadRequestMessage($this->name()),
                    'code'    => 400
                ]
            ],
            400
        );
    }

    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, 403);
    }
}
