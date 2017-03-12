<h1 align="center">Html-Wxml Converter</h1>

<p align="center">A PHP library that can convert html into wxml and back.</p>

# Requirement

- PHP >= 5.4

# Installation

```shell
$ composer require "yyxx9988/html-wxml-converter"
```

# Usage

```php
use \yyxx9988\mlconverter\Converter;

$converter = new Converter();
$converter->setHtml('<div><p><img src="..."></p></div>');
echo $converter->convert();
```

# License

MIT
