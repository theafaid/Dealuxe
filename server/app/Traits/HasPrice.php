<?php

namespace App\Traits;

use App\App\Money;

trait HasPrice
{
    /**
     * Format price according to currency
     * @return mixed
     */
    public function getFormattedPriceAttribute()
    {
        return $this->price->formatted();
    }

    /**
     * Return a money instance for the price
     * @param $value
     * @return Money
     */
    public function getPriceAttribute($value)
    {
        return new Money($value);
    }
}
