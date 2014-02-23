<?php

namespace Packfire\Config\Driver;

use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class PhpTest extends ConfigTestSetter
{
    protected function setUp()
    {
        $this->prepare('Packfire\\Config\\Driver\\Php');
    }

    public function testFile()
    {
        $this->assertEquals($this->file, $this->object->file());
    }

    public function testRead()
    {
        $data = <<<EOT
<?php
return array('test' => array('data' => 5, 'route' => false));
EOT;
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.php');
        $root->addChild($file);
        $file->withContent($data);

        $reader = new Php(vfsStream::url('root/config.php'));
        $reader->read();

        $this->assertEquals(array('test' => array('data' => 5, 'route' => false)), $reader->get());
    }

    public function testWrite()
    {
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.php');
        $root->addChild($file);

        $reader = new Php(vfsStream::url('root/config.php'));
        $reader->set('test', 5);
        $reader->set('alpha', 'bravo', 5);

        $reader->write();

        $expected = array(
            'test' => 5,
            'alpha' => array(
                'bravo' => 5
            )
        );
        $this->assertEquals($expected, include(vfsStream::url('root/config.php')));
    }
}
