<?php

namespace Cutator\Adapter;

use Cutator\Adapter\AdapterInterface;
use Cutator\Adapter\UrlGeneratorAdapter;

class SfUrlGeneratorAdapter extends UrlGeneratorAdapter implements AdapterInterface
{
    public function setUrlInfo($routeName, array $parameters = array(), $pageParameter = 'page')
    {
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