Text
===========
UA: PHP класс для форматування та редагування тексту

EN: PHP class for formatting and editing text

Встановлення / Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist irim/text "*"
```

or add

```
"irim/text": "*"
```

to the require section of your `composer.json` file.


Використання / Usage
-----


```php
<?
$text = "how use THIS fkn script";

$script = new Text('cp1251'); // change encoding, default UTF-8
$load = $script->text($text)

// Uppercase first letter
echo $load->ucFirst()->end();
//OR
echo Text::ucFirstLetter($text);
// RESULT: How use THIS fkn script

// to Title
echo $load->toTitle()->end();
// RESULT: How Use This Fkn Script

// to Upper 
echo $load->toUpper()->end();
// RESULT: HOW USE THIS FKN SCRIPT

// to Lower
echo $load->toUpper()->end();
// RESULT: how use this fkn script

// the letter "s" to the uppercase
echo $load->change('s',Text::toUpper)->end();
// RESULT: how uSe THIS fkn Script
//OR
// the letter "S" to the lowercase
echo $load->change('S',Text::toLower)->end();
// RESULT: how use THIs fkn script

?>