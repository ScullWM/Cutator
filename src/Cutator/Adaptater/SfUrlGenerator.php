<?php


namespace Cutator\Adaptater;

use Cutator;

class SfUrlGeneratorAdaptater extends Cutator\Cutator implements AdaptaterInterface
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
        $this->parameters[$pageParameter] = $page;

        return $this->urlGeneratorService->generate($this->routeName, $this->parameters);
    }
}