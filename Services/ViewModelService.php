<?php

namespace gotakk\ViewModelBundle\Services;

use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

class ViewModelService
{
    public function __construct($irregularPlurals = array())
    {
        foreach ($irregularPlurals as $singular => $plural)
            ViewModelNode::addPlural($singular, $plural);
    }

    public function createViewModel()
    {
        return new ViewModelNode();
    }
}
