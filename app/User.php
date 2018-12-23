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
        return Cart::session(auth()->id())->getContent()->count();
    }

    public function cartTotal(){
        return "$" . (Cart::session(auth()->id())->getTotal() / 100);
    }

    /**
     * Get user wishlist
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist(){
        return $this->belongsToMany('App\Product', 'user_wishlist', 'user_id', 'product_id');
    }

    /**
     * Add product to user wishlist
     * @param $product
     */
    public function addToWishlist($product){
        return $this->wishlist()->sync($product->id);
    }
}
