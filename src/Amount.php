<?php

namespace RickLuke\Money;

use RickLuke\Money\Converters\FloatConverter;
use RickLuke\Money\Converters\PercentageConverter;

class Amount
{
    /**
     * The amount.
     *
     * @var float
     */
    protected $amount;

    public function __construct($amount)
    {
        $this->amount = FloatConverter::convert($amount);
    }

    public function toFloat(): float
    {
        return (float) $this->amount;
    }

    public function add($amount)
    {
        $this->amount += FloatConverter::convert($amount);

        return $this;
    }

    public function subtract($amount)
    {
        $this->amount -= FloatConverter::convert($amount);

        return $this;
    }

    public function multiply($amount)
    {
        $this->amount *= FloatConverter::convert($amount);

        return $this;
    }

    public function divide($amount)
    {
        $this->amount /= FloatConverter::convert($amount);

        return $this;
    }

    public function addPercentage($percentage)
    {
        $this->amount += ($this->amount * PercentageConverter::convert($percentage)) / 100;

        return $this;
    }

    public function subtractPercentage($percentage)
    {
        $this->amount /= (PercentageConverter::convert($percentage) / 100 + 1);

        return $this;
    }

    public function round(int $precision, int $mode = PHP_ROUND_HALF_UP)
    {
        $this->amount = round($this->amount, $precision, $mode);
    }

    /**
     * Create a new Amount instance.
     *
     * @param mixed $amount
     *
     * @return \RickLuke\Money\Amount
     */
    public static function create($amount): Amount
    {
        return new self($amount);
    }
}
