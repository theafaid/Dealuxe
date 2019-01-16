<?php

namespace App\Filters;

use App\Category;
use App\Product;

class ShopFilters{
    /**
     * ShopFilter class is for filter the products by the request
     * it allow filter by [category, price, featured]
     */

    public static function getRandProducts(){
        return Product::inRandomOrder()->take(15);
    }

    /**
     * Filter products by category
     * @param $slug
     * @return array
     */
    public static function productsByCategory($slug){
        $category =  Category::whereSlug($slug)->firstOrFail();
        return [
            'products' => $category->products()->latest(),
            'categoryName' => $category->name
        ];
    }

    /**
     * Sort products by sortedBy request
     * @param $products
     * @param null $sortBy
     * @return mixed
     */
    public static function sortProducts($products, $sortBy = null){

        $allowedFilters = ['price_low_high', 'price_high_low', 'featured'];

        if(is_null($sortBy) || !in_array($sortBy, $allowedFilters)) return $products;


        if($sortBy == 'price_low_high'){
            $products = $products->orderBy('price', 'asc');
        }elseif($sortBy == 'price_high_low') {
            $products = $products->orderBy('price', 'desc');
        }elseif($sortBy == 'featured'){
            $products = $products->where('featured', true);
        }else{
            return $products;
        }

        return $products;
    }
}