<?php

namespace gotakk\ViewModelBundle\Tests\ViewModel;

use gotakk\ViewModelBundle\ViewModel\ViewModelAssembler;
use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

class ViewModelAssemblerTestClass extends ViewModelAssembler {}

class ViewModelAssemblerTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateViewModelBySkel()
    {
        $vm = new ViewModelNode();
        $assembler = new ViewModelAssemblerTestClass();

        $this->assertTrue($assembler->validateViewModelBySkel($vm));

        $vm = new ViewModelNode(array(
            'date' => '1970-01-01',
            'authors' => array(
                'gotakk',
            ),
            'contactInfos' => array(
                'tel' => '+1-202-555-0123',
                'fax' => '+1-202-555-0181',
                'mail' => 'fake@phpunit.com',
            ),
            'movies' => array(
                array(
                    'title' => "The Lord of the Rings: The Fellowship of the Ring",
                    'resume' => "In the Second Age of Middle Earth, the Dark Lord Sauron forges the One Ring in Mount Doom to conquer the land. An alliance of men and elves battle Sauron’s forces in Mordor, where Isildur destroys Sauron by chopping off the Ring from his body. However, the Ring’s power corrupts Isildur to prevent its destruction. Isildur is assassinated by Orcs, but the Ring is lost for 2500 years until discovered by Sméagol who is consumed by the Ring and later named Gollum. After 500 years, it abandons him, only to be unexpectedly recovered by a Hobbit named Bilbo Baggins.",
                ),
            ),
        ));

        $this->assertTrue($assembler->validateViewModelBySkel($vm, array(
            'date',
            'authors' => array(),
            'contactInfos' => array(
                'tel',
                'fax',
                'mail',
            ),
            'movies' => array(
                array(
                    'title',
                    'resume',
                ),
            ),
        )));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage date not exists
     */
    public function testValidateViewModelBySkelExceptionOne()
    {
        $assembler = new ViewModelAssemblerTestClass();
        $assembler->validateViewModelBySkel(new ViewModelNode(array(
            'authors' => array(
                'gotakk',
                'nickname' => 'gotakk',
            ),
        )), array(
            'date',
            'authors' => array(),
        ));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage authors not exists
     */
    public function testValidateViewModelBySkelExceptionTwo()
    {
        $assembler = new ViewModelAssemblerTestClass();
        $assembler->validateViewModelBySkel(new ViewModelNode(array(
            'date' => '2015-09-15',
        )), array(
            'date',
            'authors' => array(),
        ));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage contactInfos not exists
     */
    public function testValidateViewModelBySkelExceptionThree()
    {
        $assembler = new ViewModelAssemblerTestClass();
        $assembler->validateViewModelBySkel(new ViewModelNode(array(
            'date' => '2015-09-15',
            'authors' => array(
                'gotakk',
            ),
        )), array(
            'date',
            'authors' => array(),
            'contactInfos' => array(
                'tel',
                'fax',
                'mail',
            ),
        ));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage authors is not sequential array. Contains not numeric key (nickname)
     */
    public function testValidateViewModelBySkelExceptionSequentialArray()
    {
        $assembler = new ViewModelAssemblerTestClass();
        $assembler->validateViewModelBySkel(new ViewModelNode(array(
            'date' => '2015-09-01',
            'authors' => array(
                'gotakk',
                'nickname' => 'gotakk',
            ),
        )), array(
            'date',
            'authors' => array(),
        ));
    }
}
