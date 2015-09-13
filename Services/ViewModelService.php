<?php

namespace gotakk\ViewModelBundle\Services;

use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

class ViewModelService
{
    public function createViewModel()
    {
        return new ViewModelNode();
    }
}
