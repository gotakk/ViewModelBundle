<?php

namespace gotakk\ViewModelBundle\Tests\Services;

use gotakk\ViewModelBundle\Services\ViewModelService;

class ViewModelServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateViewModel()
    {
        $service = new ViewModelService();
        $vm = $service->createViewModel();

        $this->assertInstanceOf('gotakk\ViewModelBundle\ViewModel\ViewModelNode', $vm);
    }
}
