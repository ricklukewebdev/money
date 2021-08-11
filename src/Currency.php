<?php

namespace RickLuke\Money;

class Currency
{
    private $currency;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function get()
    {
        return $this->currency;
    }

    public function has()
    {
        return ($this->currency);
    }
}
