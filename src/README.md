# Money

Do you recognize the problem of retrieving money values from forms in various formats, and are you having trouble to handle these values correctly or storing them in the database?

That's exactly the issue that this small library solves. And it's done very easily:

```php
use RickLuke\Money\Money;

$value = Money::convert("€ 249,49"); // 249.49
```

Additionally, there are some basic calculation methods available that allow for manipulating the stored value.

## Installation

The project can be installed using Composer:

```bash
composer require ricklukewebdev/money
```

## Usage

At the top of your PHP-file, simply import the package:

```php
use RickLuke\Money\Money;
```

From now on, you can create a new Money instance as follows:

```php
$money = Money::create("€ 29,50");
```

To return the value as a float, you can use the _toFloat()_ method:

```php
echo $money->toFloat(); // 29.5
```

There is also a _format()_ method available (see below).

### Manipluation

Values can be manipulated in a couple of ways.

_The values in this example are based on the value mentioned earlier._

```php
// Adding
$money->add(2); // 31.5

// Subtracting
$money->subtract("5,5"); // 26

// Multiplying
$money->multiply(2.5); // 65

// Dividing
$money->divide(3); // 21.666666666667

// Working with percentages
$money->addPercentage(21); // 26.216666666667
$money->subtractPercentage("15%"); // 22.797101449275
```

### Method chaining

All of the above methods can be chained like so:

```php
$money = Money::create(20)
  ->add("€ 5,75")
  ->addPercentage("17.5%")
  ->toFloat(); // 30.25625
```

### Currencies

When creating a new Money instance, optionally a currency symbol can be provided as the second parameter. This symbol can be returned when using the _format()_ method:

```php
$money = Money::create(275, "€");
```

### Formatting

The result can be outputted as float, or can be formatted using the _format()_ method.

```php
use RickLuke\Money\Money;
use RickLuke\Money\CurrencyPosition;

$money = Money::create(19.989, "€");

// Return as float
echo $money->toFloat(); // 100

// Return formatted
echo $money->format(CurrencyPosition::LEFT, 2, ',', '.'); // € 19,99
```

The _format()_ method takes the required position of the currency symbol as the first argument. The other arguments are similar to PHP's default _number_format()_ method.

```php
// Left
echo Money::create(19.989, "€")
  ->format(CurrencyPosition::LEFT, 2, ',', '.'); // € 19,99

// Right
echo Money::create(19.989, "$")
  ->format(CurrencyPosition::RIGHT, 2, '.', ','); // 19.99 $

// Hide
echo Money::create(19.989, "USD")
  ->format(CurrencyPosition::NONE, 2, '.', ','); // 19.99
```

If preferred, the space between the currency symbol and the amount can be removed using the _removeSpace()_ method:

```php
echo Money::create(19.989, "€")
  ->removeSpace()
  ->format(CurrencyPosition::LEFT, 2, ',', '.'); // €19,99
```

## Changelog

Please take a look at the actual [CHANGELOG](CHANGELOG.md).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
