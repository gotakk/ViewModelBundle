<?php

namespace gotakk\ViewModelBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use gotakk\ViewModelBundle\DependencyInjection\gotakkViewModelExtension;
use gotakk\ViewModelBundle\Services\ViewModelService;
use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

abstract class AbstractGotakkViewModelExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $extension;
    private $container;

    protected function setUp()
    {
        $this->extension = new gotakkViewModelExtension();
        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->extension);
    }

    abstract protected function loadConfiguration(ContainerBuilder $container, $resource);

    public function testWithoutConfiguration()
    {
        $this->container->loadFromExtension($this->extension->getAlias());
        $this->container->compile();

        $this->assertTrue($this->container->has('gotakk.view_model.service'));
    }

    public function testPluralsConfiguration()
    {
        $this->loadConfiguration($this->container, 'plurals');
        $this->container->compile();

        $this->assertTrue($this->container->has('gotakk.view_model.service'));
        $service = $this->container->get('gotakk.view_model.service');

        $this->assertEquals(ViewModelNode::getPlurals(), array(
            'city' => 'cities',
            'mouse' => 'mice',
            'dependency' => 'dependencies',
            'family' => 'families',
        ));

        $vm = $service->createViewModel();
        $vm->addMouse('Mickey');
        $vm->addMouse('Jerry');
        $vm->addMan('Linus Torvaldis');
        $vm->addMan('Edward Snowden');

        $this->assertEquals($vm->toArray(), array(
            'mice' => array(
                'Mickey',
                'Jerry',
            ),
            'mans' => array(
                'Linus Torvaldis',
                'Edward Snowden',
            ),
        ));
    }
}
