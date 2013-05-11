<?php

namespace Cutator\tests\units;

require_once __DIR__.'/../../vendor/autoload.php';
include_once __DIR__.'/../../src/Cutator/cutator.php';

use \mageekguy\atoum;
use \Cutator as TestedClass;

class Cutator extends atoum\test
{
    public function testgetTotalPage()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(10);
        
        $ClassToTest->setTotalItem(99)->setItemsPerPage(20);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(5);

        $ClassToTest->setTotalItem(54)->setItemsPerPage(10);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(6);

        $ClassToTest->setTotalItem(8)->setItemsPerPage(10);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(1);

        $ClassToTest->setTotalItem(100)->setItemsPerPage(25);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(4);

        $ClassToTest->setTotalItem(101)->setItemsPerPage(25);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(5);

        $ClassToTest->setTotalItem(99)->setItemsPerPage(25);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(4);

        $ClassToTest->setTotalItem(33)->setItemsPerPage(15);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(3);
    }

    public function testgetOffset()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99);
        $this->assert->integer($ClassToTest->getTotalPage())->isEqualTo(10);
        
        $ClassToTest->setTotalItem(99)->setItemsPerPage(20)->setCurrentPage(1);
        $this->assert->integer($ClassToTest->getOffset())->isEqualTo(0);
        
        $ClassToTest->setTotalItem(99)->setItemsPerPage(20)->setCurrentPage(2);
        $this->assert->integer($ClassToTest->getOffset())->isEqualTo(20);
        
        $ClassToTest->setTotalItem(99)->setItemsPerPage(20)->setCurrentPage(3);
        $this->assert->integer($ClassToTest->getOffset())->isEqualTo(40);
    }

    public function testgetBasicView()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(10);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'));

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(8);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'));

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(6);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'));

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(4)->setShowFirstLast(false)->setMaxLinks(6);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'));

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(850)->setItemsPerPage(10)->setCurrentPage(10)->setShowFirstLast(false)->setMaxLinks(6);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'));

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(100)->setItemsPerPage(10)->setCurrentPage(10)->setShowFirstLast(false)->setMaxLinks(6);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('7'=>'7','8'=>'8','9'=>'9','10'=>'10'));

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(100)->setItemsPerPage(10)->setCurrentPage(9)->setShowFirstLast(false)->setMaxLinks(6);
        $this->assert->array($ClassToTest->getBasicView())->isEqualTo(array('6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'));
    }
}