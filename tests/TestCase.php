<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(){
        $user = create('App\User');
        $this->actingAs($user);
        return $this;
    }

    public function toCart($product){
        if(is_array($product)){
            foreach($product as $p){
                $this->addProductToCart($p);
            }
        }else{
            $this->addProductToCart($product);
        }
    }

    public function addProductToCart($product ,$qnt = 1){
        $data =  ['qnt' => $qnt, 'product' => $product->slug];
        return $this->post(route('cart.index'), $data);
    }
}
