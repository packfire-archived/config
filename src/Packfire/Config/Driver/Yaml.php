<?php

/**
 * Packfire Framework for PHP
 * By Sam-Mauris Yong
 *
 * Released open source under New BSD 3-Clause License.
 * Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
 * All rights reserved.
 */

namespace Packfire\Config\Driver;

use Packfire\Config\Config;
use Symfony\Component\Yaml\Yaml as Parser;
use Symfony\Component\Yaml\Dumper;

/**
 * A YAML Configuration File
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config\Driver
 * @since 1.0.0
 */
class Yaml extends Config
{
    /**
     * Read the configuration file
     * @since 1.0.0
     */
    public function read()
    {
        $this->data = Parser::parse($this->file);
    }

    /**
     * {@inheritdoc}
     */
    public function write($file = null)
    {
        $dumper = new Dumper();
        $yaml = $dumper->dump($this->data);
        file_put_contents($file ? $file : $this->file, $yaml);
    }
}
