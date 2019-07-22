<?php

namespace App;

/**
 * Class Utils
 * @package App
 */
class Utils
{
    /**
     * 多次元配列を一次元配列に展開する
     *
     * @param $array
     * @return array
     */
    public static function arrayCollapse($array)
    {
        $result = [];
        foreach ($array as $element) {
            if (is_array($element)) {
                $result = array_merge($result, Utils::arrayCollapse($element));
            }
            else {
                $result[] = $element;
            }
        }
        return $result;
    }
}