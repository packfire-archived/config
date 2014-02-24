<?php
namespace Packfire\Config;

use PHPUnit_Framework_TestCase;

class ArrayUtilityTest extends PHPUnit_Framework_TestCase
{
    public function testMergeRecursiveDistinct()
    {
        $alpha = array(
            'section1' => array(
                'key1' => 1,
                'key2' => 4
            )
        );
        $bravo = array(
            'section1' => array(
                'key2' => 3
            ),
            'section2' => array(
                'key1' => 5
            )
        );

        $result = array(
            'section1' => array(
                'key1' => 1,
                'key2' => 3
            ),
            'section2' => array(
                'key1' => 5
            )
        );

        $this->assertEquals($result, ArrayUtility::mergeRecursiveDistinct($alpha, $bravo));
    }
}
