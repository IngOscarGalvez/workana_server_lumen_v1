<?php

namespace App\Http\Controllers\Auth\V1;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\V1\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthLoginController extends Controller
{
    use ApiResponser;

    /**
     * login
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->AutoLogin($request);
    }

    /**
     * AutoLogin
     *
     * @return JsonResponse
     */
    public function AutoLogin($request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::attempt($credentials)) {
            return $this->errorResponse('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }
}
