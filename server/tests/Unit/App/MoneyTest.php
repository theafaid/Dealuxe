<?php

namespace Tests\Unit\App;

use App\App\Money;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    /** @test */
    function it_can_get_the_raw_amount()
    {
        $money = new Money(1000);

        $this->assertEquals($money->amount(), 1000);
    }

    /** @test */
    function it_can_get_the_formatted()
    {
        $money = new Money(1000);

        $this->assertEquals($money->formatted(), 'EGP 10.00');
    }

    /** @test */
    function it_can_add_up()
    {
        $money = new Money(1000);

        $money->add(new Money(1000));

        $this->assertEquals($money->amount(), 2000);
    }

    /** @test */
    function it_can_get_underlinying_instance()
    {
        $money = new Money(1000);

        $this->assertInstanceOf(\Money\Money::class, $money->instance());
    }
}
