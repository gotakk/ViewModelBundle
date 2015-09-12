<?php

namespace gotakk\ViewModelBundle\Tests\ViewModel;

use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

class ViewModelNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testViewModelNode()
    {
        // TEST SIMPLE OPERATIONS
        $vm = new ViewModelNode();

        $this->assertInstanceOf('gotakk\ViewModelBundle\ViewModel\ViewModelNode', $vm);
        $this->assertEmpty($vm->toArray());

        $vm->setAuthor('gotakk');
        $this->assertEquals($vm->toArray(), array(
            'author' => 'gotakk',
        ));

        $vm->setContactInfos(array(
            'tel' => '+1-202-555-0123',
            'fax' => '+1-202-555-0181',
            'mail' => 'fake@phpunit.com',
        ));
        $this->assertEquals($vm->toArray(), array(
            'author' => 'gotakk',
            'contactInfos' => array(
                'tel' => '+1-202-555-0123',
                'fax' => '+1-202-555-0181',
                'mail' => 'fake@phpunit.com',
            ),
        ));

        $movie = $vm->addMovie(array(
            'title' => "The Lord of the Rings: The Fellowship of the Ring",
            'resume' => "In the Second Age of Middle Earth, the Dark Lord Sauron forges the One Ring in Mount Doom to conquer the land. An alliance of men and elves battle Sauron’s forces in Mordor, where Isildur destroys Sauron by chopping off the Ring from his body. However, the Ring’s power corrupts Isildur to prevent its destruction. Isildur is assassinated by Orcs, but the Ring is lost for 2500 years until discovered by Sméagol who is consumed by the Ring and later named Gollum. After 500 years, it abandons him, only to be unexpectedly recovered by a Hobbit named Bilbo Baggins.",
        ));

        $this->assertInstanceOf('gotakk\ViewModelBundle\ViewModel\ViewModelNode', $movie);
        $this->assertEquals($movie->toArray(), array(
            'title' => "The Lord of the Rings: The Fellowship of the Ring",
            'resume' => "In the Second Age of Middle Earth, the Dark Lord Sauron forges the One Ring in Mount Doom to conquer the land. An alliance of men and elves battle Sauron’s forces in Mordor, where Isildur destroys Sauron by chopping off the Ring from his body. However, the Ring’s power corrupts Isildur to prevent its destruction. Isildur is assassinated by Orcs, but the Ring is lost for 2500 years until discovered by Sméagol who is consumed by the Ring and later named Gollum. After 500 years, it abandons him, only to be unexpectedly recovered by a Hobbit named Bilbo Baggins.",
        ));

        $this->assertEquals($vm->toArray(), array(
            'author' => 'gotakk',
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

        $movie->addCharacter('Frodon');
        $this->assertEquals($movie->toArray(), array(
            'title' => "The Lord of the Rings: The Fellowship of the Ring",
            'resume' => "In the Second Age of Middle Earth, the Dark Lord Sauron forges the One Ring in Mount Doom to conquer the land. An alliance of men and elves battle Sauron’s forces in Mordor, where Isildur destroys Sauron by chopping off the Ring from his body. However, the Ring’s power corrupts Isildur to prevent its destruction. Isildur is assassinated by Orcs, but the Ring is lost for 2500 years until discovered by Sméagol who is consumed by the Ring and later named Gollum. After 500 years, it abandons him, only to be unexpectedly recovered by a Hobbit named Bilbo Baggins.",
            'characters' => array(
                'Frodon',
            ),
        ));

        $movie->setProperties(array(
            'language' => 'english',
            'budget' => '$93 million',
            'boxOffice' => '$871.5 million',
        ));

        $this->assertEquals($movie->toArray(), array(
            'title' => "The Lord of the Rings: The Fellowship of the Ring",
            'resume' => "In the Second Age of Middle Earth, the Dark Lord Sauron forges the One Ring in Mount Doom to conquer the land. An alliance of men and elves battle Sauron’s forces in Mordor, where Isildur destroys Sauron by chopping off the Ring from his body. However, the Ring’s power corrupts Isildur to prevent its destruction. Isildur is assassinated by Orcs, but the Ring is lost for 2500 years until discovered by Sméagol who is consumed by the Ring and later named Gollum. After 500 years, it abandons him, only to be unexpectedly recovered by a Hobbit named Bilbo Baggins.",
            'characters' => array(
                'Frodon',
            ),
            'properties' => array(
                'language' => 'english',
                'budget' => '$93 million',
                'boxOffice' => '$871.5 million',
            ),
        ));
    }
}
