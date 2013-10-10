<?php


namespace Cutator\View;

use Cutator;

class TwBootstrapView extends Cutator\CutatorView implements ViewInterface
{

    private $htmlContainer   = '<ul class="pagination">{paginationContent}</ul>';
    private $itemCurrentLink = '<li class="active"><a href="{itemUrl}">{itemPage} <span class="sr-only">(current)</span></a></li>';
    private $itemLink        = '<li><a href="{itemUrl}">{itemPage}</a></li>';

    /**
     * Render TwBootstrap html template
     *
     * @version  04-10-2013
     * @return String Html Output
     */
    public function render()
    {
        $items = $this->getLinksRender($this->getBasicView());
        $output = str_replace('{paginationContent}', $items, $this->htmlContainer);

        return (string) $output;
    }
}