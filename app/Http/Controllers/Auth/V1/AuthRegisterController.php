<?php

namespace App\Http\Controllers\Auth\V1;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\V1\RegisterRequest;

class AuthRegisterController extends AuthLoginController
{
    use ApiResponser;

    /**
     * @var User
     */
    protected $user;
    /**
     * __construct
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * register
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $this->user->name = $request->name;
                $this->user->email = $request->email;
                $this->user->password = app('hash')->make($request->password);
                $this->user->save();
            }, 3);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->AutoLogin($request);
    }
}
