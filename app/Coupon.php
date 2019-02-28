<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    /**
     * Find a coupon by its code
     * @param $code
     * @return mixed
     */
    public static function findByCode($code){
        return static::where('code', $code)->first();
    }

    /**
     * Return the discount according to the coupon type
     * @param null $total
     * @return float|int|mixed
     */
    public function discount($total = null){
        if($this->type == 'fixed' || $total == null){
            return $this->value;
        }

        return ($total * $this->value) / 100; // to dollars
    }

    /**
     * Store a coupon into a session
     * @param $cartTotal
     */
    public function addToSession($cartTotal){
        if($cartTotal <= 0) return;
        return session()->put('coupon', [
            'code' => $this->code,
            'discount' => $this->discount($cartTotal),
            'value' => 'dollar'
        ]);
    }
}
