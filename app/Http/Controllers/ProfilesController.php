<?php

namespace App\Http\Controllers;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        return view('profile', [
            'user' => $user->load('profile')
        ]);
    }
}
