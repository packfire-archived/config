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
 * @since 1.0.0
 */
interface ConfigInterface
{
    /**
     * Get the value from the configuration file.
     *
     * You can get values nested inside arrays by entering multiple keys as
     * arguments to the method.
     *
     * Example:
     * <code>$value = $config->get('app', 'name'); // $data = array('app' => array('name' => 'Packfire')); </code>
     * <code>$value = $config->get('database', 'default', 'host'); // $data = array('database' => array('default' => array('host' => 'localhost'))); </code>
     *
     * @param string $key,... The key of the data to load.
     * @return mixed Returns the data read or NULL if the key is not found.
     * @since 1.0.0
     */
    public function get();

    /**
     * @return void
     */
    public function set($key, $value);

    public function defaults(ConfigInterface $defaults);

    public function merge(ConfigInterface $config);
}
