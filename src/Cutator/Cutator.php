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

use Cutator\Base\CutatorBase;
use Cutator\Exception\UrlGeneratorException;
use Cutator\Exception\ViewException;

class Cutator extends CutatorBase
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
                if(!is_object($value)) throw new UrlGeneratorException("UrlGenerator is not an object!", 1);
                // Only SfUrlGeneratorAdapter is available at this time
                $this->urlGenerator = $value;

            }elseif($property=="view"){
                if(!is_object($value)) throw new ViewException("View is not an object!", 1);
                $this->view = $value;

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

    public function getTemplateView()
    {
        if(empty($this->urlGenerator)) throw new \Exception("UrlGenerator is not an object!", 1);

        
    }
}
