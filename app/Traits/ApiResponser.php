<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

trait ApiResponser
{
    /**
     * successResponse
     *
     * @param string $data
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($data, $code): JsonResponse
    {
        return response()->json(
            [
                'status'   => 'Success',
                'code'     => $code,
                'messages' => [],
                'result'   => $data,
            ],
            $code
        );
    }

    /**
     * errorResponse
     *
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code): JsonResponse
    {
        return response()->json(
            [
                'status'   => 'Error',
                'code'     => $code,
                'messages' => $message,
                'result'   => [],
            ],
            $code
        );
    }

    /**
     * showData
     *
     * @param object $collection
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showData($collection, $code = 200): JsonResponse
    {
        return $this->successResponse($collection, $code);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->successResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ], Response::HTTP_OK);
    }
}
