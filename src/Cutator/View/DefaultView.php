<?php


namespace Cutator\View;

use Cutator;

class DefaultView extends Cutator\Cutator implements ViewInterface
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

    public function rendermini()
    {

    }
}