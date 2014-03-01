<?php

namespace Packfire\Config\Driver;

use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class IniTest extends PHPUnit_Framework_TestCase
{
    public function testFile()
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
        $file = vfsStream::url('root/config.ini');
        $config = new Ini($file);
        $config->read();
        $this->assertEquals($file, $config->file());
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
        $config = new Ini(vfsStream::url('root/config.ini'));
        $config->read();

        $this->assertEquals(array('test' => array('data' => 5, 'route' => false)), $config->get());
    }

    public function testWrite()
    {
        $root = vfsStream::setup('root');
        $file = vfsStream::newFile('config.ini');
        $root->addChild($file);

        $config = new Ini(vfsStream::url('root/config.ini'));
        $config->set('test', 'epic', 5);
        $config->set('alpha', 'bravo', 5);

        $config->write();

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
