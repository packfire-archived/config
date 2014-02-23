<?php /*
 * Copyright (C) 2014 Sam-Mauris Yong. All rights reserved.
 * This file is part of the Packfire Config component project, which is released under New BSD 3-Clause license.
 * See file LICENSE or go to http://opensource.org/licenses/BSD-3-Clause for full license details.
 */

namespace Packfire\Config\Driver;

use Packfire\Config\File;
use Mauris\Ini\Dumper;

/**
 * An INI configuration file
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config\Driver
 * @since 1.0.0
 */
class Ini extends File
{
    /**
     * {@inheritdoc}
     */
    public function read()
    {
        $this->data = parse_ini_file($this->file, true);
    }

    /**
     * {@inheritdoc}
     */
    public function write($file = null)
    {
        $dumper = new Dumper();
        $output = $dumper->dump($this->data);
        file_put_contents($file ? $file : $this->file, $output);
    }
}
