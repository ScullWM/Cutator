<?php

namespace Cutator\Base;

use Cutator\Exception\UrlGeneratorException;

abstract class ViewBase
{
    /**
     * List of pagination
     * 
     * @var array
     */
    protected $list = array();

    /**
     * Url Generator Engine
     * 
     */
    protected $urlGenerator = null;

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
        $links          = array_map(array($this, $renderFunction), $links, array_keys($links));

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
        $link    = $this->itemLink;
        $itemUrl = $this->urlGenerator->getUrl($pageKey);
        $link    = str_replace('{itemUrl}', $itemUrl, $link);
        $link    = str_replace('{itemPage}', $page, $link);
        return $link;
    }

    /**
     * Set simple pagination array generated by Cutator
     *
     * @version  20-05-14
     * @param array $list Result of getBasicView
     */
    public function setBasicView(array $list = array())
    {
        $this->list = $list;
    }


    /**
     * Set Url Generator Engine, could be not defined
     *
     * @version  20-05-14
     * @param object $urlGenerator Could be different object pattern
     */
    public function setUrlGenerator($urlGenerator)
    {
        if(!is_object($urlGenerator)) throw new UrlGeneratorException("UrlGenerator is not an object!", 1);
        $this->urlGenerator = $urlGenerator;

        return $this;
    }

    /**
     * Give to UrlGenerator all information
     *
     * @version  20-05-14
     * @param  string $routeName     RouteName in use
     * @param  array  $parameters    List of extra parameter for the url
     * @param  string $pageParameter Parameter name used for paginate
     */
    public function hydrateRouter($routeName, array $parameters = array(), $pageParameter = 'page')
    {
        $this->urlGenerator->setRouteName($routeName);
        $this->urlGenerator->setParameters($parameters);
        $this->urlGenerator->setPageParameter($pageParameter);
    }
}