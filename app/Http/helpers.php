<?php


/**
 * Return a slug attribute from an item collection
 */
if(!function_exists('slugFromItem')){

    function slugFromItem($item){
        return $item['attributes']['product']['slug'];
    }
}

/**
 * Format product price
 */
if(!function_exists('presentPrice')){
    function presentPrice($price){
        return "$" . $price / 100;
    }
}

/**
 * Active class for category
 */

if(!function_exists('setActiveCategory')){

    function setActiveCategory($slug , $output = 'active'){

        $category = request('category');
        $sortBy   = request('sortBy');

        if($slug == 'all_categories' && ! $category && ! $sortBy){
            return $output;
        }

        if($slug == 'featured' && ! $category && $sortBy == 'featured'){
            return $output;
        }

        return request('category') == $slug ? $output : null;
    }
}

/**
 * Get App locale
 */
if(!function_exists('lang')){
    function lang(){
        return app()->getLocale();
    }
}

/**
 * Get stock level
 */

if(!function_exists('getStockLevel')){
    function getStockLevel($quantity){
        $stockThreshold = setting('site.stock_threshold') ?: 0;
        if($quantity == 0){
            return "<span class='badge badge-danger'>" . __('front.notAvailable') . "</span>";
        }

        $available = __('front.available') . "( {$quantity} )";


        if($quantity >= $stockThreshold){
            $stockLevel = "<span class='badge badge-success'>" . __('front.inStock') . " - {$available}". "</span>";
        }else{
            $stockLevel = "<span class='badge badge-warning'>" . __('front.lowStock') . " - {$available}"  . "</span>";
        }

        return $stockLevel;
    }
}