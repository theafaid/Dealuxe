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

    public function toSaveLater($product){
        if(is_array($product)){
            foreach($product as $p){
                $this->post(route('wishlist.store'), [
                    'product' => $p->slug
                ]); 
            }
        }else{
            return $this->post(route('wishlist.store'), [
                'product' => $product->slug
            ]); 
        }
    }

    public function generateProductThenToCart(){
        $product = create('App\Product');
        $this->toCart($product);
    }

    public function storeCoupon($coupon = null){
        return $this->post(route('coupon.store'),
        [
            'coupon' => $coupon ? $coupon->code : null
        ]);
    }
}
