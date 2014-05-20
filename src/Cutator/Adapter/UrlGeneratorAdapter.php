<?php

namespace Cutator\Adapter;

abstract class UrlGeneratorAdapter
{
    /**
     * $urlGeneratorService Engine
     * @var objecturlGeneratorService
     */
    protected $urlGeneratorService = null;
    protected $routeName;
    protected $parameters;
    protected $pageParameter = 'page';
    /**
     * Construct
     * 
     * @version  20-05-14
     * @param [type] $urlGeneratorService [description]
     */
    public function __construct($urlGeneratorService)
    {
        $this->setUrlGenerator($urlGeneratorService);
    }

    /**
     * Set Url Generator
     *
     * @version  20-05-14
     * @param [type] $urlGeneratorService [description]
     */
    public function setUrlGenerator($urlGeneratorService)
    {
        $this->urlGeneratorService = $urlGeneratorService;
    }

    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    public function setParameters(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    public function setPageParameter($pageParameter = 'page')
    {
        $this->pageParameter = $pageParameter;
    }
}