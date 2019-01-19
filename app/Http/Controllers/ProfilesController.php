<?php

namespace App\Http\Controllers;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
