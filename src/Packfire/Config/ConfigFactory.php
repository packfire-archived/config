<?php /*
 * Copyright (C) 2014 Sam-Mauris Yong. All rights reserved.
 * This file is part of the Packfire Config component project, which is released under New BSD 3-Clause license.
 * See file LICENSE or go to http://opensource.org/licenses/BSD-3-Clause for full license details.
 */

namespace Packfire\Config;

/**
 * Factory class to create the appropriate Config class
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config
 * @since 1.0.0
 */
class ConfigFactory
{
    /**
     * Load a configuration file
     * @param string $file Path to the configuration file
     * @param \Packfire\Config\Config $defaults (optional) The default configuration data to load with.
     * @return \Packfire\Config\Config Returns the loaded configuration, or NULL if failed to
     *                 find the appropriate configuration parser.
     * @since 1.0
     */
    public function load($file, $defaults = null)
    {
        $map = ConfigType::typeMap();
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (isset($map[$ext])) {
            $class = 'Packfire\\Config\\Driver\\' . $map[$ext];
            $config = new $class($file);
            $config->read();
            if ($defaults) {
                $config->defaults($defaults);
            }
            return $config;
        } else {
            return null;
        }
    }
}
