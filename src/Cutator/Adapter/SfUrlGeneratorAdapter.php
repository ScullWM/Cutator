<?php

namespace Cutator\Adapter;

use Cutator\Cutator;
use Cutator\Adapter\AdapterInterface;

class SfUrlGeneratorAdapter extends Cutator implements AdapterInterface
{
    private $urlGeneratorService;
    private $routeName;
    private $parameters;
    private $pageParameter;

    public function __construct($urlGeneratorService, $routeName, $parameters, $pageParameter = 'page')
    {
		$this->urlGeneratorService = $urlGeneratorService;
		$this->routeName           = $routeName;
		$this->parameters          = $parameters;
		$this->pageParameter       = $pageParameter;
    }

    public function getUrl($page)
    {
        $this->parameters[$this->pageParameter] = $page;
        return $this->urlGeneratorService->generate($this->routeName, $this->parameters);
    }
}