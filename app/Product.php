<?php

namespace App;

use Cart;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, Searchable;

    protected $guarded = [];
    protected $appends = ['inCart', 'inWishlist'];

    public $translatable = ['name', 'description', 'details'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function getImageAttribute($value){
        if(! is_null($value) && file_exists("storage/{$value}")) return "/storage/".$value;

        return "/storage/design/images/default/no-product-img.jpg";
    }
    /**
     * Change the actual price to dollar format
     * @return string
     */
    public function presentPrice(){
        return "$" . $this->price / 100;
    }

    /**
     * Check if the quantity of the product bigger
     * than the order quantity
     * @param $quantity
     * @return bool
     */
    public function hasCount($quantity){
        return $this->quantity >= $quantity;
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

    public function categories(){
        return $this->belongsToMany('App\Category');
    }
    /**
     * Check if the product is in the authenticated user wishlist
     * @return bool
     */
    public function getInWishlistAttribute(){
        // return auth()->user() ? $this->fans()->where('user_id', auth()->id())->exists() : false;
        if(! $user = auth()->user()) return false;
        $wishlistIds = $user->wishlist->pluck('id')->toArray();

        return in_array($this->id, $wishlistIds);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $attributes = [
            'path' => route('shop.show', $this->slug),
            'categories' => $this->categories->pluck('name')->toArray()
        ];

        return array_merge($this->toArray(), $attributes);
//        return $this->toArray() + ['categories' => $this->categories->pluck('name')->toArray()];
    }
}
