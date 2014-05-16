<?php

/**
 * Cutator
 *
 * Copyright (c) 2013, Thomas Perez <thomas@scullwm.com>.
 * All rights reserved.
 *
 * @package    Cutator
 * @author     Thomas Perez <thomas@scullwm.com>
 * @copyright  2013 Thomas Perez <thomas@scullwm.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       https://github.com/scullwm/Cutator
 * @version    Release: 0.1
 */

namespace Cutator;

use Cutator\Adapter\SfUrlGeneratorAdapter;

class Cutator implements \Countable, \IteratorAggregate
{
    protected $currentPage   = 1;
    protected $itemsPerPage  = 10;
    protected $maxLinks      = 10;
    protected $showFirstLast = false;
    protected $view          = 'Default';
    protected $totalItem;
    protected $offset;
    public    $startName     = 'Début';
    public    $endName       = 'Fin';

    /**
     * if array given, will dispatch value to class's attributes
     * Some property launch some events
     *
     * @version  17-05-14
     * @param array $array
     */
    public function __construct(array $parameters = array())
    {
        foreach ($parameters as $property=>$value) {
            if($property=="urlGenerator"){
                if(!is_object($value)) throw new \Exception("UrlGenerator is not an object!", 1);                
                // Only SfUrlGeneratorAdapter is available at this time
                $this->urlGenerator = new SfUrlGeneratorAdapter($value);

            }elseif (property_exists($this, $property)) {
                $this->$property = $value;

            }else {
                trigger_error("Unexistant property could not been set");
            }
        }
    }

    /**
     * Return simple array for display nav
     *
     * @version 13-05-2013
     * @return array
     */
    public function getBasicView()
    {
        // For adding later first and last link
        $nbreLinks          = ($this->showFirstLast===true)?$this->maxLinks-2:$this->maxLinks;
        $amplitudePoint     = floor($nbreLinks/2);
        $startPoint         = (($this->currentPage-$amplitudePoint)>0)?$this->currentPage-$amplitudePoint:1;
        $potentialEndPoint  = ($startPoint+$nbreLinks)-1;
        $endPoint           = ($potentialEndPoint<$this->getTotalPage())?$potentialEndPoint:$this->getTotalPage();

        // Create an array
        $linkArray  = range($startPoint, $endPoint);
        $linksView  = array_combine($linkArray, $linkArray);

        // Add FirstLast Links
        if ($this->showFirstLast===true) {
            $linksView[1]                     = $this->startName;
            $linksView[$this->getTotalPage()] = $this->endName;
        }
        // Sort it for direct display
        ksort($linksView);

        return $linksView;
    }

    /**
     * Return NextPage int
     * return false if there is no next page
     *
     * @return Integer
     */
    public function getNextPage()
    {
        $nextPage = $this->currentPage+1;
        if($nextPage>$this->getTotalPage()) {
            return false;
        }

        return (int) $nextPage;
    }

    /**
     * Return PreviousPage int
     * return false if there is no previous page
     *
     * @return Integer
     */
    public function getPreviousPage()
    {
        $previousPage = $this->currentPage-1;
        if($previousPage<=0) {
            return false;
        }

        return (int) $previousPage;
    }

    /**
     * Do you need to show pagination?
     *
     * @return Boolean
     */
    public function getHaveToPaginate()
    {
        return (bool) ($this->totalItem>$this->itemsPerPage);
    }

    /**
     * Return Offset Limit
     *
     * @return Integer
     */
    public function getOffset()
    {
        return (int) ($this->currentPage*$this->itemsPerPage)-$this->itemsPerPage;
    }

    /**
     * Basic calcul of the number of page needed
     *
     * @return Integer
     */
    public function getTotalPage()
    {
        return (int) $this->totalPage = ceil($this->totalItem/$this->itemsPerPage);
    }

    /**
     * Define current page displayed
     *
     * @param Integer $value
     */
    public function setCurrentPage($value)
    {
        $this->currentPage = (int) $value;

        return $this;
    }

    /**
     * Set maximum of items in a page
     *
     * @param Integer $value
     */
    public function setItemsPerPage($value)
    {
        $this->itemsPerPage = (int) $value;

        return $this;
    }

    /**
     * Set maximum link wanted for pagination navigation
     * Integrate the ShowFirstLast statut
     *
     * @param integer $value
     */
    public function setMaxLinks($value)
    {
        $this->maxLinks = (int) $value;

        return $this;
    }

    /**
     * Set the total of items in presence
     *
     * @param Integer $value
     */
    public function setTotalItem($value)
    {
        $this->totalItem = (int) $value;

        return $this;
    }

    /**
     * Set if cutator will display first and end page
     * Will accept true, false, 1, 0 value's
     *
     * @param Boolean $value
     */
    public function setShowFirstLast($value)
    {
        $this->showFirstLast = (bool) $value;

        return $this;
    }

    /**
     * Return actual page displayed
     *
     * @return integer
     */
    public function getCurrentPage()
    {
        return (int) $this->currentPage;
    }

    /**
     * Return number of item displayed per page
     *
     * @return integer
     */
    public function getItemsPerPage()
    {
        return (int) $this->itemsPerPage;
    }

    /**
     * Return total of link
     *
     * @return integer
     */
    public function getMaxLinks()
    {
        return (int) $this->maxLinks;
    }

    /**
     * Return Total item
     *
     * @return integer
     */
    public function getTotalItem()
    {
        return (int) $this->totalItem;
    }

    /**
     * Return if cutator will display first and end page
     *
     * @return Boolean
     */
    public function getShowFirstLast()
    {
        return (bool) $this->showFirstLast;
    }

    /**
     * Return Total item
     *
     * @return integer
     */
    public function count()
    {
        return $this->getTotalItem();
    }

    /**
     * Return current Iterator
     *
     * @return integer
     */
    public function getIterator()
    {
        return $this->getCurrentPage();
    }
}
