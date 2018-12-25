<?php

namespace App;

use Cart;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $guarded = [];
    protected $appends = ['inCart', 'inWishlist'];

    public $translatable = ['name', 'description', 'details'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    /**
     * Change the actual price to dollar format
     * @return string
     */
    public function presentPrice(){
        return "$" . $this->price / 100;
    }

    /**
     * Fetch might also like products
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function scopeMightLike($query, $limit = 8){
        return $query->inRandomOrder()->take($limit);
    }

    /**
     * Check if the product is in the authenticated user cart
     * @return bool
     */
    public function getInCartAttribute(){
        return auth()->user() ? !! Cart::session(auth()->id())->get($this->id) : false;
    }

    /**
     * Fans are users who add the product to them whishlist
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fans(){
        return $this->belongsToMany('App\User', 'user_wishlist', 'product_id', 'user_id');
    }

    /**
     * Check if the product is in the authenticated user wishlist
     * @return bool
     */
    public function getInWishlistAttribute(){
        return true;
        $wishlistIds = auth()->user()->wishlist->pluck('id')->toArray();
        return in_array($this->id, $wishlistIds);

//        return auth()->user() ? $this->fans()->where('user_id', auth()->id())->exists() : false;
    }
}
