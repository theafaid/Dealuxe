<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAddressRequest;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show authenticated user profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('profile', [
            'user' => auth()->user()->load(['profile', 'orders'])
        ]);
    }

    /**
     * Update authenticated user address
     * @param UpdateAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAddress(UpdateAddressRequest $request){
        return $request->persist();
    }
}
