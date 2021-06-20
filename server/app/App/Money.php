<?php

namespace App\App;

use Money\Currency;
use NumberFormatter;
use Money\Money as BaseMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class Money
{
    protected $money;

    /**
     * Money constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('EGP'));
    }

    /**
     * Get the amount only from the money instance
     * @return string
     */
    public function amount()
    {
        return $this->money->getAmount();
    }

    /**
     * Money format according to currency
     * @return string
     */
    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('EGP', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );
        return $formatter->format($this->money);
    }

    /**
     * Add a money instance for the current value of money
     * @param Money $money
     * @return $this
     */
    public function add(Money $money)
    {
        $this->money = $this->money->add($money->instance());

        return $this;
    }

    /**
     * Return instance of the money
     * @return BaseMoney
     */
    public function instance()
    {
        return $this->money;
    }
}
