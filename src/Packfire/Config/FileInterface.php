<?php /*
 * Copyright (C) 2014 Sam-Mauris Yong. All rights reserved.
 * This file is part of the Packfire Config component project, which is released under New BSD 3-Clause license.
 * See file LICENSE or go to http://opensource.org/licenses/BSD-3-Clause for full license details.
 */

namespace Packfire\Config;

/**
 * Interfacing and abstraction for configurations
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config
 * @since 1.1.0
 */
interface FileInterface
{
    /**
     * Create the File object with a file
     * @since 1.1.0
     */
    public function __construct($file);

    /**
     * Read the configuration file
     * @since 1.1.0
     */
    public function read();

    /**
     * Write to a configuration file
     * @param string $file (optional) The name of the file to write to. If not provided, it will write over the original file.
     * @since 1.1.0
     */
    public function write($file = null);

    /**
     * Get the path to the file loaded
     * @return string Returns the path to the configuration file.
     * @since 1.1.0
     */
    public function file();
}
