<?php

namespace App\Http\Controllers\APIAuth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\PrivateUserResource;

class RegisterController extends Controller
{
    public function __invoke(RegisterFormRequest $requset)
    {
        $user = User::create($requset->validated());

        return response(new PrivateUserResource($user), 201);
    }
}
