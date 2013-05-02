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
 * @since 1.0.1
 */
class ArrayUtility {
    
    public static function mergeRecursiveDistinct(&$array1, &$array2){
        $merged = $array1;
        foreach($array2 as $key => &$value){
            if (is_array($value) && isset($merged [$key]) && is_array($merged [$key])){
              $merged [$key] = self::mergeRecursiveDistinct($merged [$key], $value);
            }else {
              $merged [$key] = $value;
            }
        }
        return $merged;
    }
    
}