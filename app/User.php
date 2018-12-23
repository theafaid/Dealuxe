<?php

namespace App;

use Cart;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cartItems(){
        return Cart::session(auth()->id())->getContent();
    }

    public function cartItemsCount(){
        return Cart::session(auth()->id())->getContent();
    }

    public function cartTotal(){
        return "$" . (Cart::session(auth()->id())->getTotal() / 100);
    }
}
