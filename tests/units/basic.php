<?php 



    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

include_once __DIR__.'/../../src/Cutator/cutator.php';

use Cutator\Cutator as Cutator;


$var = new Cutator();

$var->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(10);

echo'<pre>';
print_r($var->getBasicView());
echo'<hr>';
print_r($var);
echo'</pre>';