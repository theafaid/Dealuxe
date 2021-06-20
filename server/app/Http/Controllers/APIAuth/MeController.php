<?php

namespace App\Http\Controllers\APIAuth;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;

class MeController extends Controller
{
    /**
     * MeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return PrivateUserResource
     */
    public function __invoke()
    {
        return new PrivateUserResource(auth()->user());
    }
}
