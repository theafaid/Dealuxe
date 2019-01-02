<?php

namespace Tests\Unit;

use App\Coupon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function can_get_the_discount_for_the_coupon(){
        $total = 10000; // $100

        $coupon = create('App\Coupon', ['type' => 'fixed', 'value' => 1000]);

        $this->assertEquals($coupon->value, $coupon->discount($total));

        $coupon = create('App\Coupon', ['type' => 'percent', 'value' => 10]);

        $this->assertEquals(1000, $coupon->discount($total));

        $coupon = create('App\Coupon', ['type' => 'percent', 'value' => 50]);

        $this->assertEquals(5000, $coupon->discount($total));

    }

    /** @test */
    function can_fetch_a_coupon_by_its_code(){
        $coupon = create('App\Coupon', ['type' => 'fixed', 'value' => 1000]);

        $this->assertEquals(Coupon::findByCode($coupon->code)->id, $coupon->id);
    }

    /** @test */
    function can_be_added_to_a_session(){
        $coupon = create('App\Coupon');
        $coupon->addToSession($cartTotal = 100);

        $this->assertTrue(session()->has('coupon'));
        $this->assertEquals(session('coupon')['discount'], $coupon->discount());
    }
}

