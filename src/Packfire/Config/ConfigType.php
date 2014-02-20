<?php /*
 * Copyright (C) 2014 Sam-Mauris Yong. All rights reserved.
 * This file is part of the Packfire Config component project, which is released under New BSD 3-Clause license.
 * See file LICENSE or go to http://opensource.org/licenses/BSD-3-Clause for full license details.
 */

namespace Packfire\Config;

/**
 * Configuration file extensions and class mapping
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config
 * @since 1.0.0
 */
class ConfigType
{
    /**
     * Provides the file type and class mapping information
     * @return array Returns the file type and class mapping information in array.
     * @since 1.0.0
     */
    public static function typeMap()
    {
        static $map = array(
                'yml' => 'Yaml',
                'yaml' => 'Yaml',
                'json' => 'Json',
                'ini' => 'Ini',
                'php' => 'Php'
            );
        return $map;
    }
}
