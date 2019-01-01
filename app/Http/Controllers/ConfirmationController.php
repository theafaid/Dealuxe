<?php

namespace App\Http\Controllers;

class ConfirmationController extends Controller
{
    public function index(){
      return  session()->has('payment_succeded') ? view('thankyou') : abort(404);
    }
}
