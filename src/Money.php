<?php

namespace RickLuke\Money;

use RickLuke\Money\Amount;
use RickLuke\Money\Currency;

class Money
{
    /**
     * @var \RickLuke\Money\Amount
     */
    private $amount;

    /**
     * @var \RickLuke\Money\Currency
     */
    private $currency;

    /**
     * The space between the currency and the amount, that can be removed using
     * the method removeSpace().
     *
     * @var string
     */
    private $space = ' ';

    /**
     * Create a new Money object.
     *
     * @param mixed  $amount
     * @param string $currency
     */
    public function __construct($amount, $currency = null)
    {
        $this->amount   = new Amount($amount);
        $this->currency = new Currency($currency);
    }

    /**
     * Return the value as a formatted string.
     * 
     * @param string $currencyPosition
     * @param int    $decimals
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     * 
     * @return string
     */
    public function format($currencyPosition = null, $decimals = 2, $decimalSeparator = '.', $thousandsSeparator = ',')
    {
        return $this->addCurrency($currencyPosition, number_format($this->amount->toFloat(), $decimals, $decimalSeparator, $thousandsSeparator));
    }

    /**
     * Add the currency to the string.
     *
     * @param string $currencyPosition
     * @param string $amount
     *
     * @return string
     */
    protected function addCurrency($currencyPosition, $amount): string
    {
        if (!$this->currency->has()) {
            $currencyPosition = null;
        }

        if ($currencyPosition == 'left') {
            return $this->currency->get() . $this->space . $amount;
        }

        if ($currencyPosition == 'right') {
            return $amount . $this->space . $this->currency->get();
        }

        return $amount;
    }

    /**
     * Return the amount as a float.
     *
     * @return float
     */
    public function toFloat(): float
    {
        return $this->amount->toFloat();
    }

    /**
     * Remove the space between the currency and the amount after formatting.
     *
     * @return \RickLuke\Money\Money
     */
    public function removeSpace(): Money
    {
        $this->space = '';

        return $this;
    }

    /**
     * Add another amount to the existing amount.
     *
     * @param mixed $amount
     *
     * @return \RickLuke\Money\Money
     */
    public function add($amount): Money
    {
        $this->amount->add($amount);

        return $this;
    }

    /**
     * Subtract an amount from the existing amount.
     *
     * @param mixed $amount
     *
     * @return \RickLuke\Money\Money
     */
    public function subtract($amount): Money
    {
        $this->amount->subtract($amount);

        return $this;
    }

    /**
     * Multiply the existing amount.
     *
     * @param mixed $amount
     *
     * @return \RickLuke\Money\Money
     */
    public function multiply($amount): Money
    {
        $this->amount->multiply($amount);

        return $this;
    }

    /**
     * Divide the existing amount by the provided amount.
     *
     * @param mixed $amount
     *
     * @return \RickLuke\Money\Money
     */
    public function divide($amount): Money
    {
        $this->amount->divide($amount);

        return $this;
    }

    /**
     * Add a percentage to the existing amount.
     * 
     * Useful for calculating vat.
     *
     * @param mixed $percentage
     *
     * @return \RickLuke\Money\Money
     */
    public function addPercentage($percentage): Money
    {
        $this->amount->addPercentage($percentage);

        return $this;
    }

    /**
     * Add a percentage to the existing amount.
     * 
     * Useful for calculating discounts.
     *
     * @param mixed $percentage
     *
     * @return \RickLuke\Money\Money
     */
    public function subtractPercentage($percentage): Money
    {
        $this->amount->subtractPercentage($percentage);

        return $this;
    }

    /**
     * Round the amount.
     *
     * @param int $precision
     * @param int $mode
     *
     * @return \RickLuke\Money\Money
     */
    public function round(int $precision, int $mode = PHP_ROUND_HALF_UP): Money
    {
        $this->amount->round($precision, $mode);

        return $this;
    }

    /**
     * Create a new Money instance.
     *
     * @param mixed $amount
     * @param mixed $currency
     *
     * @return \RickLuke\Money\Money
     */
    public static function create($amount, $currency = null): Money
    {
        return new Money($amount, $currency);
    }

    /**
     * Converts the provided input to a float.
     *
     * @param mixed $amount
     * @param mixed $currency
     *
     * @return float
     */
    public static function convert($amount, $currency = null): float
    {
        return self::create($amount, $currency)->toFloat();
    }
}
