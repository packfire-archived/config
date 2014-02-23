<?php

namespace Packfire\Config\Driver;

use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class IniTest extends ConfigTestSetter
{
    protected function setUp()
    {
        $this->prepare('Packfire\\Config\\Driver\\Ini');
    }

    public function testFile()
    {
        $this->assertEquals($this->file, $this->object->file());
    }

    public function testRead()
    {
        $data = <<<EOT
[test]
data=5
route=false
EOT;
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.ini');
        $root->addChild($file);
        $file->withContent($data);
        $reader = new Ini(vfsStream::url('root/config.ini'));
        $reader->read();

        $this->assertEquals(array('test' => array('data' => 5, 'route' => false)), $reader->get());
    }

    public function testWrite()
    {
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.ini');
        $root->addChild($file);

        $reader = new Ini(vfsStream::url('root/config.ini'));
        $reader->set('test', 'epic', 5);
        $reader->set('alpha', 'bravo', 5);

        $reader->write();

        $expected = array(
            'test' => array(
                'epic' => 5
            ),
            'alpha' => array(
                'bravo' => 5
            )
        );
        $this->assertEquals($expected, parse_ini_file(vfsStream::url('root/config.ini'), true));
    }
}
