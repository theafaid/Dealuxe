<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    public static function findByCode($code){
        return static::where('code', $code)->first();
    }

    public function discount($total = null){
        if($this->type == 'fixed' || $total == null){
            return $this->value;
        }

        return ($total * $this->value) / 100;
    }
}
