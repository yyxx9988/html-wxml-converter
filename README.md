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

# Customize

- Default supported tags
```php
[
    'p' => 'view',
    'h1' => 'view',
    'h2' => 'view',
    'h3' => 'view',
    'h4' => 'view',
    'h5' => 'view',
    'h6' => 'view',
    'ul' => 'view',
    'ol' => 'view',
    'li' => 'view',
    'div' => 'view',
    'nav' => 'view',
    'pre' => 'view',
    'code' => 'view',
    'menu' => 'view',
    'aside' => 'view',
    'header' => 'view',
    'footer' => 'view',
    'legend' => 'view',
    'section' => 'view',
    'article' => 'view',
    'caption' => 'view',
    'details' => 'view',
    'summary' => 'view',
    'menuitem' => 'view',
    'blockquote' => 'view',

    'i' => 'text',
    'b' => 'text',
    's' => 'text',
    'u' => 'text',
    'big' => 'text',
    'del' => 'text',
    'sub' => 'text',
    'sup' => 'text',
    'ins' => 'text',
    'font' => 'text',
    'mark' => 'text',
    'time' => 'text',
    'span' => 'text',
    'center' => 'text',
    'strong' => 'text',
    'strike' => 'text',
];
```

- Customize special tags

```php
$converter = new Converter();

// add a tag
$converter->addHtmlTags('xxx', 'view');

// change a tag
$converter->setHtmlTags('li', 'text');

// remove a tag
$converter->removeHtmlTags('article');

echo $converter->convert();
```

# License

MIT
