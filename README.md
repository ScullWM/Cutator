# Cutator
Simple pagination class for PHP 5.3. Define you value, get the result.

[![Total Downloads](https://poser.pugx.org/scullwm/cutator/downloads.png)](https://packagist.org/packages/scullwm/cutator)
[![Build Status](https://secure.travis-ci.org/ScullWM/Cutator.png)](http://travis-ci.org/ScullWM/Cutator)

## Why
If you don't wan't to install thousand dependency for simple offset calcul

## Simple Usage
```php
<?php

$var = new Cutator();

$var->setTotalItem(850);           // no default value
$var->setItemsPerPage(10);         // default value 10
$var->setCurrentPage(8);           // default value 1
$var->setShowFirstLast(false);     // default value false
$var->setMaxLinks(10);             // default value 10

// Can be defined in a single line
$var->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(8)->setShowFirstLast(false)->setMaxLinks(10);

$var->getTotalPage();              // 85 Return integer: number of page needed 
$var->getOffset();                 // 70 Return integer: offset starting value 
$var->getHaveToPaginate();         // True Return boolean: do you need to display pagination 
$var->getNextPage();               // 9 Return integer 
$var->getPreviousPage();           // 7 Return integer

$t = $var->getBasicView();         // Return array: return simple array for creating pager

print_r($t);

/*
Array
(
    [3] => 3
    [4] => 4
    [5] => 5
    [6] => 6
    [7] => 7
    [8] => 8
    [9] => 9
    [10] => 10
    [11] => 11
    [12] => 12
)
*/
?>
```
## View And url Generator Usage
```php
<?php

$urlGenerator = new \Cutator\Adapter\SfUrlGeneratorAdapter($app['url_generator']);

$view = new \Cutator\View\TwBootstrapView();
$view->setUrlGenerator($urlGenerator);

$cutator = new Cutator\Cutator();
$cutator->setView($view);

$cutator->setUrlInfo('liste');

echo $cutator->getTemplateView();
?>
```

## Tests
Test with Atoum
php vendor/atoum/atoum/bin/atoum -f tests/units/Cutator.php

## Todo
- Create extension for array pagination
- Write more tests
- Write Extension for Silex (serviceProvider)