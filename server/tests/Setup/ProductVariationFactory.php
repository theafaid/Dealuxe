<?php

namespace Tests\Setup;

use App\Models\ProductVariation;
use App\Models\Stock;

class ProductVariationFactory
{
    protected $stocks = 0;
    protected $additionalStocks = 0;
    /**
     * Attach a stocks for the product variation
     * @param int $quantity
     * @return $this
     */
    public function withStocks($quantity = 0)
    {
        $this->stocks = $quantity;

        return $this;
    }

    public function addAdditionalStocks($quantity = 0)
    {
        $this->additionalStocks = $quantity;

        return $this;
    }
    /**
     * Create product variation with it's stocks if requested
     * @param null $count
     * @param array $data
     * @return mixed
     */
    public function create($count = null, $data = [])
    {
        $productVariation =  factory(ProductVariation::class, $count && $count != 1 ? $count : null)->create($data);

        if($this->stocks) $this->attachStocks($productVariation, $this->stocks);

        return $productVariation;
    }

    /**
     * Create a stocks for product variation
     * @param $productVariation
     * @param $qnt
     */
    protected function attachStocks($productVariation, $qnt)
    {
        $productVariation->stocks()->save(
            factory(Stock::class)->make(['quantity' => $qnt])
        );

        if($additional = $this->additionalStocks) {
            $this->additionalStocks = 0;
            $this->attachStocks($productVariation, $additional);
        };
    }
}
