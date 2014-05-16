<?php

namespace Cutator\View;

use Cutator\Cutator;
use Cutator\View\ViewInterface;

class TwBootstrapView extends Cutator implements ViewInterface
{

    protected $htmlContainer   = '<ul class="pagination">{paginationContent}</ul>';
    protected $itemCurrentLink = '<li class="active"><a href="{itemUrl}">{itemPage} <span class="sr-only">(current)</span></a></li>';
    protected $itemLink        = '<li><a href="{itemUrl}">{itemPage}</a></li>';

    /**
     * Render TwBootstrap html template
     *
     * @version  04-10-2013
     * @return String Html Output
     */
    public function render()
    {
        $items = $this->getAllLinksRender($this->getBasicView());
        $output = str_replace('{paginationContent}', $items, $this->htmlContainer);

        return (string) $output;
    }
}