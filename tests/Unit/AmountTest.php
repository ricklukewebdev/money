<?php

namespace RickLuke\Money\Tests\Unit;

use RickLuke\Money\Amount;
use PHPUnit\Framework\TestCase;

class AmountTest extends TestCase
{
    /** @test */
    public function strings_are_converted_to_floats()
    {
        $this->assertSame(500.00, Amount::create("500")->toFloat());
        $this->assertSame(500.00, Amount::create("$500")->toFloat());
        $this->assertSame(500.00, Amount::create("500 euro")->toFloat());
        $this->assertSame(500.50, Amount::create("500,50")->toFloat());
        $this->assertSame(500.50, Amount::create("500.50")->toFloat());
    }
}
