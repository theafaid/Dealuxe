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

