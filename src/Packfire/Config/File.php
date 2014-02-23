<?php /*
 * Copyright (C) 2014 Sam-Mauris Yong. All rights reserved.
 * This file is part of the Packfire Config component project, which is released under New BSD 3-Clause license.
 * See file LICENSE or go to http://opensource.org/licenses/BSD-3-Clause for full license details.
 */

namespace Packfire\Config;

/**
 * A PHP configuration file that returns an array of configuration information.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config
 * @since 1.1.0
 */
abstract class File extends Config implements FileInterface
{
    /**
     * The pathname to the configuration file
     * @var string
     * @since 1.1.0
     */
    protected $file;

    /**
     * Create a new configuration file
     * @param string $file Name of the configuration file to load
     * @since 1.1.0
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get the loaded configuration file path
     * @return A string consisting the config file path
     * @since 1.1.0
     */
    public function file()
    {
        return $this->file;
    }
}
