<?php

if(! function_exists('create')){
    function create($modelName, $attributes = [], $count = null){
        return factory($modelName, $count)->create($attributes);
    }
}

if(! function_exists('make')){
    function make($modelName, $attributes = [], $count = null){
        return factory($modelName, $count)->make($attributes);
    }
}