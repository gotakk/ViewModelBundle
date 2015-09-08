<?php

namespace gotakk\ViewModelBundle\Services;

use gotakk\ViewModelBundle\ViewModel\ViewModelNode;
use gotakk\ViewModelBundle\Validator\ViewModelValidator;

class ViewModelService
{
    public function createViewModel()
    {
        return new ViewModelNode();
    }
}
