<?php

namespace Cutator\Base;

abstract class ViewBase
{

    /**
     * Generate html output for pagination display
     *
     * @version  04-10-2013
     * @param  Array $links Render of getBasicView
     * @return String        Html content
     */
    protected function getAllLinksRender($links)
    {
        $renderFunction = (isset($this->urlGenerator) && !empty($this->urlGenerator))?'getUrlServiceLinkRender':'getBasicLinkRender';
        $links = array_map(array($this, $renderFunction), $links, array_keys($links));

        return implode('', $links);
    }

    /**
     * Generate a link item with basic url html url
     *
     * @version  04-10-2013
     * @param  String $page    May contain string
     * @param  Integer $pageKey Page Item
     * @return String          Html item output
     */
    private function getBasicLinkRender($page, $pageKey)
    {
        $link = $this->itemLink;
        $link = str_replace('{itemUrl}', '?page='.$pageKey, $link);
        $link = str_replace('{itemPage}', $page, $link);
        return $link;
    }

    /**
     * Generate an url with a Url Generator service (Adaptater)
     *
     * @version  04-10-2013
     * @param  String $page    May contain string
     * @param  Integer $pageKey Page Item
     * @return String          Html item output
     */
    private function getUrlServiceLinkRender($page, $pageKey)
    {
        $link = $this->itemLink;
        $itemUrl = $this->urlGenerator->getUrl($pageKey);
        $link = str_replace('{itemUrl}', $pageKey, $link);
        $link = str_replace('{itemPage}', $page, $link);
        return $link;
    }
}