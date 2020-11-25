<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

trait JsonRespondController
{
    /**
     * @var int
     */
    protected $httpStatusCode = 200;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * Get HTTP status code of the response.
     *
     * @return int
     */
    public function getHTTPStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * Set HTTP status code of the response.
     *
     * @param int $statusCode
     * @return self
     */
    public function setHTTPStatusCode($statusCode)
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    /**
     * Get error code of the response.
     *
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Set error code of the response.
     *
     * @param int $errorCode
     * @return self
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Sends a JSON to the consumer.
     *
     * @param  array $data
     * @param  array  $headers [description]
     * @return JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getHTTPStatusCode(), $headers);
    }

    /**
     * Sends a response not found (404) to the request.
     * Error Code = 31.
     *
     * @return JsonResponse
     */
    public function respondNotFound()
    {
        return $this->setHTTPStatusCode(404)
                    ->setErrorCode(31)
                    ->respondWithError();
    }

    /**
     * Sends an error when the validator failed.
     * Error Code = 32.
     *
     * @param Validator $validator
     * @return JsonResponse
     */
    public function respondValidatorFailed(Validator $validator)
    {
        return $this->setHTTPStatusCode(422)
                    ->setErrorCode(32)
                    ->respondWithError($validator->errors()->all());
    }

    /**
     * Sends an error when the query didn't have the right parameters for
     * creating an object.
     * Error Code = 33.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondNotTheRightParameters($message = null)
    {
        return $this->setHTTPStatusCode(500)
                    ->setErrorCode(33)
                    ->respondWithError($message);
    }

    /**
     * Sends a response invalid query (http 500) to the request.
     * Error Code = 40.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondInvalidQuery($message = null)
    {
        return $this->setHTTPStatusCode(500)
                    ->setErrorCode(40)
                    ->respondWithError($message);
    }

    /**
     * Sends an error when the query contains invalid parameters.
     * Error Code = 41.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondInvalidParameters($message = null)
    {
        return $this->setHTTPStatusCode(422)
                    ->setErrorCode(41)
                    ->respondWithError($message);
    }

    /**
     * Sends a response unauthorized (401) to the request.
     * Error Code = 42.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondUnauthorized($message = null)
    {
        return $this->setHTTPStatusCode(401)
                    ->setErrorCode(42)
                    ->respondWithError($message);
    }

    /**
     * Sends a response with error.
     *
     * @param string|array $message
     * @return JsonResponse
     */
    public function respondWithError($message = null)
    {
        return $this->respond([
            'error' => [
                'message' => $message ?? config('api.error_codes.'.$this->getErrorCode()),
                'error_code' => $this->getErrorCode(),
            ],
        ]);
    }

    /**
     * Sends a response that the object has been deleted, and also indicates
     * the id of the object that has been deleted.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function respondObjectDeleted($id)
    {
        return $this->respond([
            'deleted' => true,
            'id' => $id,
        ]);
    }

    function mainResponse ($status, $msg, $items, $code = 200, $pages = null)
    {
        if (isset(json_decode(json_encode($items, true), true)['data'])) {
            $pagination = json_decode(json_encode($items, true), true);
            $items = $pagination['data'];
            $pages = [
                "current_page" => $pagination['current_page'],
                "first_page_url" => $pagination['first_page_url'],
                "from" => $pagination['from'],
                "last_page" => $pagination['last_page'],
                "last_page_url" => $pagination['last_page_url'],
                "next_page_url" => $pagination['next_page_url'],
                "path" => $pagination['path'],
                "per_page" => $pagination['per_page'],
                "prev_page_url" => $pagination['prev_page_url'],
                "to" => $pagination['to'],
                "total" => $pagination['total'],
            ];
        } else {
            $pages = [
                "current_page" => 0,
                "first_page_url" => '',
                "from" => 0,
                "last_page" => 0,
                "last_page_url" => '',
                "next_page_url" => null,
                "path" => '',
                "per_page" => 0,
                "prev_page_url" => null,
                "to" => 0,
                "total" => 0,
            ];
        }

        if (!null($items)){
            $newData = ['status' => $status, 'message' => __($msg), 'items' => $items];
        }else {
            $newData = ['status' => $status, 'message' => __($msg)];
        }
//        $newData = ['status' => $status, 'message' => __($msg), 'items' => $items, 'pages' => $pages];

        return response()->json($newData);
    }

    function mainWithoutItemsResponse ($status, $msg, $code = 200, $pages = null)
    {
        $newData = ['status' => $status, 'message' => __($msg)];

        return response()->json($newData, $code);
    }
}
