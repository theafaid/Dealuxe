<?php

namespace App;

use Cart;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
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

    protected $withCount = ['wishlist'];
    protected $with = ['wishlist'];

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

    public function cartTotal($toDollar = true, $dollarSign = true){
        $dollarSign = $dollarSign ? "$" : null;
        $total = Cart::session($this->id)->getTotal();
        return $dollarSign . ($toDollar ? $total/100 : $total);
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
        $wishlist = $this->wishlist();

        if(! $wishlist->where(['product_id' => $product->id])->exists()){
            return $this->wishlist()->attach($product->id);
        }
        return;
    }

    /**
     * Remove a product from user wish list
     * @param $product
     * @return int|void
     */
    public function removeFromWishlist($product){
        $wishlist = $this->wishlist();
        if($wishlist->where(['product_id' => $product->id])->exists()){
            return $wishlist->detach($product->id);
        }
        return;
    }

    /**
     * Get user profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(){
        return $this->hasOne('App\Profile');
    }
}
