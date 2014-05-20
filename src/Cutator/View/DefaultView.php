<?php

namespace Cutator\View;

use Cutator\Cutator;
use Cutator\View\ViewInterface;
use Cutator\Base\ViewBase;

class DefaultView extends ViewBase implements ViewInterface
{

    /**
     * Render basic html template
     * So lazy
     *
     * @version  03-10-2013
     * @return String Html Output
     */
    public function render()
    {
        $list = $this->getBasicView();

        $output = '<ul>';
        foreach($list as $lKey=>$lValue) {
            $output .= '<li><a href="?page='.$lKey.'">'.$lValue.'</a></li>';
        }
        $output .= '</ul>';

        return $output;
    }
}