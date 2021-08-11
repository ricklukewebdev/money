<?php

namespace RickLuke\Money\Tests\Unit;

use RickLuke\Money\Money;
use PHPUnit\Framework\TestCase;
use RickLuke\Money\CurrencyPosition;

class MoneyTest extends TestCase
{
    /** @test */
    public function amounts_are_converted_to_decimals()
    {
        $money = Money::create(10.95);

        $this->assertEquals(10.95, $money->toFloat());
    }

    /** @test */
    public function it_can_add_amounts()
    {
        $this->assertEquals(125.45, Money::create("12,95")->add("$100.50")->add("12 euros")->toFloat());
    }

    /** @test */
    public function it_can_subtract_amounts()
    {
        $this->assertEquals(-62.01, Money::create(1.99)->subtract(64)->toFloat());
    }

    /** @test */
    public function it_can_multiply_the_amount_by_the_given_amount()
    {
        $this->assertEquals(189.375, Money::create(75.75)->multiply("2,5")->toFloat());
    }

    /** @test */
    public function it_can_divide_the_amount_by_the_given_amount()
    {
        $this->assertEquals(12.5, Money::create(25)->divide(2)->toFloat());
    }

    /** @test */
    public function it_can_add_percentages()
    {
        $this->assertEquals(20.57, Money::create(17)->addPercentage(21)->toFloat());
    }

    /** @test */
    public function it_can_subtract_percentages()
    {
        $this->assertEquals(14.05, Money::create(17)->subtractPercentage(21)->round(2)->toFloat());
    }

    public function it_can_round_amounts()
    {
        $this->assertEquals(1.234, Money::create(1.23456)->round(3)->toFloat());
        $this->assertEquals(1, Money::create(1.23456)->round(0)->toFloat());
    }

    /** @test */
    public function it_can_convert_inputs_to_floats()
    {
        $this->assertEquals(9.99, Money::convert("9.99"));
    }

    /** @test */
    public function the_result_can_be_formatted()
    {
        $this->assertEquals("1.055,55", Money::create(1055.545)->format(null, 2, ',', '.'));
    }

    /** @test */
    public function the_currency_position_can_be_set()
    {
        $this->assertEquals('€ 75.00', Money::create(75, '€')->format(CurrencyPosition::LEFT));
        $this->assertEquals('75.00 €', Money::create(75, '€')->format(CurrencyPosition::RIGHT));
        $this->assertEquals('75.00', Money::create(75, '€')->format(CurrencyPosition::NONE));
    }

    /** @test */
    public function the_space_between_currency_and_amount_can_be_removed()
    {
        $this->assertEquals("$1,999.99", Money::create("1999.99", '$')->removeSpace()->format(CurrencyPosition::LEFT));
    }
}
