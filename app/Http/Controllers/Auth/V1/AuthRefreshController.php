<?php

namespace App\Http\Controllers\Auth\V1;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthRefreshController extends Controller
{
    use ApiResponser;

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(Auth::refresh());
    }
}
