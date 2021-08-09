<?php

namespace App\Http\Controllers\Auth\V1;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthLogoutController extends Controller
{
    use ApiResponser;
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return $this->showData(
            [
                'message' => "Successfully logged out",
            ],
            Response::HTTP_OK
        );
    }
}
