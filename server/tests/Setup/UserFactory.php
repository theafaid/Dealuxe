<?php

namespace Tests\Setup;

use App\Models\User;
use App\Models\Stock;

class UserFactory
{
    protected $cartProductsCount;
    protected $cartProductQuantity;
    protected $customProductData;
    protected $stockCount;
    protected $withAddress = false;
    protected $address;

    public function withAddress($address = null)
    {
        $this->withAddress = true;
        $this->address = $address;

        return $this;
    }

    /**
     * @param $productVariationsCount
     * @param $quantityOfVariation
     * @param array $customData
     * @param bool $inStock
     * @param int $stockCount
     * @return $this
     * @throws \Exception
     */
    public function putInCart($productVariationsCount, $quantityOfVariation, $stockCount = 0, $customData = [])
    {
        $this->stockCount = $stockCount;
        $this->customProductData = $customData;
        $this->cartProductsCount = $productVariationsCount;
        $this->cartProductQuantity = $quantityOfVariation;

        return $this;
    }

    /**
     * @param null $count
     * @param array $data
     * @return mixed
     */
    public function create($count = null, $data = [])
    {
        // create a user
        $user =  factory(User::class, $count && $count != 1 ? $count : null)->create($data);

        // put items for cart if requested
        if($this->cartProductsCount)  $this->fillUserCart($user);

        // assign an address for the user if requested
        if($this->withAddress){
            if($this->address){
                $user->addresses()->save($this->address);
            }else{
                $user->addresses()->save(
                    \Facades\Tests\Setup\AddressFactory::create()
                );
            }
        }

        return $user->fresh();
    }

    /**
     * @return mixed
     */
    public function make()
    {
        return factory(User::class)->make();
    }

    /**
     * Fill the user cart
     * @param $user
     * @param $productsCount
     * @param $quantity
     */
    protected function fillUserCart($user)
    {
        $productVariations = \Facades\Tests\Setup\ProductVariationFactory::create($this->cartProductsCount, $this->customProductData);

        if($this->cartProductsCount == 1){
            factory(Stock::class)->create(['product_variation_id' => $productVariations->id, 'quantity' => $this->stockCount]);
        }else{
            collect($productVariations)->each(function ($product) {
                factory(Stock::class)->create(['product_variation_id' => $product->id, 'quantity' => $this->stockCount]);
            });
        }

        $user->cart()->attach( $productVariations, ['quantity' => $this->cartProductQuantity] );
    }
}
