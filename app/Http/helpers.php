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

        if($slug == 'featured' && ! $category && $sortBy){
            return $output;
        }

        return request('category') == $slug ? $output : null;
    }
}