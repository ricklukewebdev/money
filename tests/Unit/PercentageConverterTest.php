<?php

namespace RickLuke\Money\Tests\Unit;

use PHPUnit\Framework\TestCase;
use RickLuke\Money\Converters\PercentageConverter;

class PercentageConverterTest extends TestCase
{
    /** @test */
    public function percentages_are_converted_to_floats()
    {
        $this->assertEquals(11, PercentageConverter::convert("11%"));
        $this->assertEquals(12, PercentageConverter::convert("12 percent"));
        $this->assertEquals(13, PercentageConverter::convert(13));
        $this->assertEquals(14.5, PercentageConverter::convert("14,50"));
        $this->assertEquals(15.75, PercentageConverter::convert("15,75%"));
    }
}
