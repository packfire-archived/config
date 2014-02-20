<?php

/**
 * Packfire Framework for PHP
 * By Sam-Mauris Yong
 *
 * Released open source under New BSD 3-Clause License.
 * Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
 * All rights reserved.
 */

namespace Packfire\Config;

/**
 * A generic configuration file
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Config
 * @since 1.0.0
 */
abstract class Config implements ConfigInterface
{
    /**
     * The pathname to the configuration file
     * @var string
     * @since 1.0.0
     */
    protected $file;

    /**
     * The data read from the configuration file
     * @var array
     * @since 1.0.0
     */
    protected $data = array();

    /**
     * Create a new configuration file
     * @param string $file Name of the configuration file to load
     * @since 1.0.0
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Read the configuration file
     * @since 1.0.0
     */
    abstract public function read();

    /**
     * Write to a configuration file
     * @param string $file (optional) The name of the file to write to. If not provided, it will write over the original file.
     * @since 1.0.3
     */
    abstract public function write($file = null);

    /**
     * Set the defaults for missing configuration
     * @param \Packfire\Config\ConfigInterface $defaults The default configuration to place
     * @since 1.0.0
     */
    public function defaults(ConfigInterface $defaults)
    {
        $this->data = ArrayUtility::mergeRecursiveDistinct($defaults->get(), $this->data);
    }

    /**
     * Merge the configuration from the other Config
     * @param \Packfire\Config\ConfigInterface $config The configuration to merge in
     * @since 1.2.0
     */
    public function merge(ConfigInterface $config)
    {
        $this->data = ArrayUtility::mergeRecursiveDistinct($this->data, $config->get());
    }

    /**
     * Get the path to the file loaded
     * @return string Returns the path to the configuration file.
     * @since 1.0-sofia
     */
    public function file()
    {
        return $this->file;
    }

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
     * @since 1.0-sofia
     */
    public function get()
    {
        $keys = func_get_args();
        $data = $this->data;
        foreach ($keys as $key) {
            if (is_array($data)) {
                if (isset($data[$key])) {
                    $data = $data[$key];
                } else {
                    $data = null;
                    break;
                }
            } else {
                break;
            }
        }
        return $data;
    }

    /**
     * Set a value to the configuration data
     *
     * You can set values nested inside arrays by entering multiple keys as
     * arguments to the method.
     *
     * Example:
     * <code>$config->set('app', 'name', 'Packfire'); </code>
     * <code>$config->set('database', 'default', 'host', 'localhost');</code>
     *
     * @param string $key,... The key of the data to load.
     * @param mixed $value,... The value to set
     * @since 1.0.2
     */
    public function set($key, $value)
    {
        $keys = func_get_args();
        $value = array_pop($keys);
        $this->setValueRecursive($this->data, $keys, $value);
    }

    protected function setValueRecursive(&$scope, $keys, $value)
    {
        $key = array_shift($keys);
        if ($keys) {
            if (!isset($scope[$key]) || null === $scope[$key]) {
                $scope[$key] = array();
            }
            $this->setValueRecursive($scope[$key], $keys, $value);
        } else {
            $scope[$key] = $value;
        }
    }
}
