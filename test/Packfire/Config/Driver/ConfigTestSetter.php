<?php
namespace Packfire\Config\Driver;

abstract class ConfigTestSetter extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Packfire\Config\IConfig
     */
    protected $object;

    protected $file = 'test/Files/sampleConfig';

    public function prepare($class)
    {
        $this->object = $this->getMock($class, array('read'), array($this->file));

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

    public function testFile()
    {
        $this->assertEquals($this->file, $this->object->file());
    }

    public function testConfigGet()
    {
        $this->assertNotNull($this->object->get('first_section'));
        $this->assertNotNull($this->object->get('second_section'));
        $this->assertNotNull($this->object->get('third_section'));
        $this->assertCount(3, $this->object->get());

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

    public function testConfigSet()
    {
        $this->object->set('first_section', 'one', 5);
        $this->assertEquals(5, $this->object->get('first_section', 'one'));
        $this->object->set('once', false);
        $this->assertEquals(false, $this->object->get('once'));
    }
}
