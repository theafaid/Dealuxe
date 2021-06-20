<?php

namespace App\Services\Auth;

use App\Http\Resources\PrivateUserResource;

class UserLoginService
{
    /**
     * Login a user
     * @param $credentials
     * @return PrivateUserResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login($credentials)
    {

        if(! $token = $this->tryLogin($credentials)){
            return response($this->failedLoginMessages(), 422);
        }

        return $this->loginSuccessResponse($token);
    }

    /**
     * Try user to login
     * @param $data
     * @return mixed[user token]
     */
    protected function tryLogin($data)
    {
        return auth()->guard('api')->attempt($data);
    }

    /**
     * Return a response if valid credentials
     * @param $token
     * @return PrivateUserResource
     */
    protected function loginSuccessResponse($token)
    {
        return (new PrivateUserResource(auth()->user()))->additional([
            'meta' => ['token' => $token ]
        ]);
    }

    /**
     * Return a response if invalid credentials
     * @return array
     */
    protected function failedLoginMessages()
    {
        return [
            'errors' => [ 'email' => [__('auth.failed')] ]
        ];
    }
}
