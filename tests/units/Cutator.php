<?php

namespace Cutator\tests\units;

require_once __DIR__.'/../../vendor/autoload.php';

use \mageekguy\atoum;
use \Cutator as TestedClass;

class Cutator extends atoum\test
{
    public function testsetShowFirstLast()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setShowFirstLast(true);
        $this->assert->boolean($ClassToTest->getShowFirstLast())->isEqualTo(true);

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setShowFirstLast(false);
        $this->assert->boolean($ClassToTest->getShowFirstLast())->isEqualTo(false);

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setShowFirstLast(1);
        $this->assert->boolean($ClassToTest->getShowFirstLast())->isEqualTo(true);

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setShowFirstLast(0);
        $this->assert->boolean($ClassToTest->getShowFirstLast())->isEqualTo(false);
    }

    public function testsetTotalItem()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(1);
        $this->assert->integer($ClassToTest->getTotalItem())->isEqualTo(1);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(0);
        $this->assert->integer($ClassToTest->getTotalItem())->isEqualTo(0);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(150);
        $this->assert->integer($ClassToTest->getTotalItem())->isEqualTo(150);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99);
        $this->assert->integer($ClassToTest->getTotalItem())->isEqualTo(99);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(25)->setTotalItem(50);
        $this->assert->integer($ClassToTest->getTotalItem())->isEqualTo(50);        
    }


    public function testsetMaxLinks()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setMaxLinks(1);
        $this->assert->integer($ClassToTest->getMaxLinks())->isEqualTo(1);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setMaxLinks(0);
        $this->assert->integer($ClassToTest->getMaxLinks())->isEqualTo(0);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setMaxLinks(150);
        $this->assert->integer($ClassToTest->getMaxLinks())->isEqualTo(150);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setMaxLinks(99);
        $this->assert->integer($ClassToTest->getMaxLinks())->isEqualTo(99);        

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setMaxLinks(25)->setMaxLinks(50);
        $this->assert->integer($ClassToTest->getMaxLinks())->isEqualTo(50);        
    }


    public function testgetItemsPerPage()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setItemsPerPage(99);
        $this->assert->integer($ClassToTest->getItemsPerPage())->isEqualTo(99);

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setItemsPerPage(1);
        $this->assert->integer($ClassToTest->getItemsPerPage())->isEqualTo(1);

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setItemsPerPage(0);
        $this->assert->integer($ClassToTest->getItemsPerPage())->isEqualTo(0);

        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setItemsPerPage(99)->setItemsPerPage(20);
        $this->assert->integer($ClassToTest->getItemsPerPage())->isEqualTo(20);
    }

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


    public function testgetNextPage()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(10);
        $this->assert->integer($ClassToTest->getNextPage())->isEqualTo(2);

        $ClassToTest->setCurrentPage(2);
        $this->assert->integer($ClassToTest->getNextPage())->isEqualTo(3);

        $ClassToTest->setCurrentPage(10);
        $this->assert->boolean($ClassToTest->getNextPage())->isEqualTo(false);
    }


    public function testgetPreviousPage()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(10);
        $this->assert->boolean($ClassToTest->getPreviousPage())->isEqualTo(false);

        $ClassToTest->setCurrentPage(2);
        $this->assert->integer($ClassToTest->getPreviousPage())->isEqualTo(1);

        $ClassToTest->setCurrentPage(10);
        $this->assert->integer($ClassToTest->getPreviousPage())->isEqualTo(9);
    }


    public function testcount()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(10);
        $this->assert->integer($ClassToTest->count())->isEqualTo(99);

        $ClassToTest->setTotalItem(0);
        $this->assert->integer($ClassToTest->count())->isEqualTo(0);

        $ClassToTest->setTotalItem(21);
        $this->assert->integer($ClassToTest->count())->isEqualTo(21);
    }

    public function testgetIterator()
    {
        $ClassToTest = new TestedClass\Cutator();
        $ClassToTest->setTotalItem(99)->setItemsPerPage(10)->setCurrentPage(1)->setShowFirstLast(false)->setMaxLinks(10);
        $this->assert->integer($ClassToTest->getIterator())->isEqualTo(1);

        $ClassToTest->setCurrentPage(4);
        $this->assert->integer($ClassToTest->getIterator())->isEqualTo(4);

        $ClassToTest->setCurrentPage(7);
        $this->assert->integer($ClassToTest->getIterator())->isEqualTo(7);
    }
}