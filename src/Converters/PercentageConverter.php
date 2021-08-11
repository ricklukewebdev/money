<?php

namespace RickLuke\Money\Converters;

use RickLuke\Money\Contracts\ConverterContract;

class PercentageConverter extends Converter implements ConverterContract
{
    public function handle($input)
    {
        if (is_float($input)) {
            return $input;
        }

        $cleanString = preg_replace('/([^0-9\.,])/i', '', $input);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $input);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

        return (float) str_replace(',', '.', $removedThousandSeparator);
    }
}
