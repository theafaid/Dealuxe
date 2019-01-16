<?php

namespace App;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasTranslations;
    protected static function boot(){
        parent::boot();
        static::creating(function($category){
            $category->slug = str_slug($category->name);
        });
    }
    protected $guarded = [];
    public $translatable = ['name'];

    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
