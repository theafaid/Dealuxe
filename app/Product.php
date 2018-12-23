<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['name', 'description', 'details'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function presentPrice(){
        return "$" . $this->price / 100;
    }

    public function scopeMightLike($query, $limit = 8){
        return $query->inRandomOrder()->take($limit);
    }
}
