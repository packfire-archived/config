<?php
namespace Packfire\Config;

use PHPUnit_Framework_TestCase;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Config();

        $property = new \ReflectionProperty($this->object, 'data');
        $property->setAccessible(true);
        $data = array(
            'first_section' => array(
                'one' => 1,
                'five' => 5,
                'animal' => 'BIRD'
            ),
            'second_section' => array(
                'path' => '/usr/local/bin',
                'URL' => 'http://www.example.com/~username'
            ),
            'third_section' => array(
                'phpversion' => array(
                    '5.0',
                    '5.1',
                    '5.2',
                    '5.3'
                )
            )
        );
        $property->setValue($this->object, $data);
    }

    public function testGet()
    {
        $this->assertNotNull($this->object->get('second_section'));
        $this->assertNotNull($this->object->get('first_section'));
        $this->assertNotNull($this->object->get('third_section'));
        $this->assertCount(3, $this->object->get());

        $this->assertNull($this->object->get('second_section', 'Singapore'));
        $this->assertEquals($this->object->get('second_section', 'path'), $this->object->get('second_section', 'path', 'ranger'));

        $this->assertEquals(1, $this->object->get('first_section', 'one'));
        $this->assertEquals('BIRD', $this->object->get('first_section', 'animal'));

        $this->assertEquals(
            array(
                'path' => '/usr/local/bin',
                'URL' => 'http://www.example.com/~username'
            ),
            $this->object->get('second_section')
        );
    }

    public function testSet()
    {
        $this->object->set('first_section', 'one', 5);
        $this->assertEquals(5, $this->object->get('first_section', 'one'));
        $this->object->set('once', false);
        $this->assertEquals(false, $this->object->get('once'));

        $this->object->set('alpha_section', 'one', null);
        $this->assertEquals(null, $this->object->get('alpha_section', 'one'));
        $this->object->set('alpha_section', 'one', 'real', true);
        $this->assertEquals(array('real' => true), $this->object->get('alpha_section', 'one'));
    }
}
