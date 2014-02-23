<?php

namespace Packfire\Config\Driver;

use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Yaml as Parser;
use PHPUnit_Framework_TestCase;

class YamlTest extends ConfigTestSetter
{
    protected function setUp()
    {
        $this->prepare('Packfire\\Config\\Driver\\Yaml');
    }

    public function testFile()
    {
        $this->assertEquals($this->file, $this->object->file());
    }

    public function testRead()
    {
        $data = <<<EOT
---
test:
  data: 5
  route: false
...
EOT;
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.yml');
        $root->addChild($file);
        $file->withContent($data);

        $reader = new Yaml(vfsStream::url('root/config.yml'));
        $reader->read();

        $this->assertEquals(array('test' => array('data' => 5, 'route' => false)), $reader->get());
    }

    public function testWrite()
    {
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.yml');
        $root->addChild($file);

        $reader = new Yaml(vfsStream::url('root/config.yml'));
        $reader->set('test', 5);
        $reader->set('alpha', 'bravo', 5);

        $reader->write();

        $expected = array(
            'test' => 5,
            'alpha' => array(
                'bravo' => 5
            )
        );
        $this->assertEquals($expected, Parser::parse(vfsStream::url('root/config.yml')));
    }
}
