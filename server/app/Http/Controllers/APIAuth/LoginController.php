<?php

namespace App\Http\Controllers\APIAuth;

use App\Http\Controllers\Controller;
use App\Services\Auth\UserLoginService;
use App\Http\Requests\LoginFormRequest;
use App\Http\Resources\PrivateUserResource;

class LoginController extends Controller
{
    protected $service;

    /**
     * LoginController constructor.
     * @param UserLoginService $service
     */
    public function __construct(UserLoginService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginFormRequest $request
     * @return PrivateUserResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(LoginFormRequest $request)
    {
        return $this->service->login($request->validated());
    }
}
