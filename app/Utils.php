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

    /**
     * Fisher-Yates Shuffle
     *
     * @param $array
     * @return mixed
     */
    public static function fisherYatesShuffle($array)
    {
        for ($i = count($array) - 1; $i > 0; $i--) {
            $r = mt_rand(0, $i);
            $tmp = $array[$i];
            $array[$i] = $array[$r];
            $array[$r] = $tmp;
        }

        return $array;
    }

    /**
     * ファイルパスかどうか
     *
     * @param $argv
     * @return bool
     */
    public static function isFilePath($argv)
    {
        if (strpos($argv, '/') === false) return false;
        return true;
    }

    /**
     * CSVファイルを配列に変換する
     *
     * @param $filePath
     * @return array
     */
    public static function csvToArray($filePath)
    {
        // TODO: CSVファイルかどうか

        $file = new \SplFileObject($filePath);
        $file->setFlags(\SplFileObject::READ_CSV);

        $array = [];
        foreach ($file as $line) {
            mb_convert_variables('UTF-8', ['ASCII', 'JIS', 'EUC-JP', 'SJIS'], $line[0]);
            $array[] = $line;
        }

        return $array;
    }

    /**
     * 文字列を配列に変換する
     *
     * @param $string
     * @return array
     */
    public static function stringToArray($string)
    {
        $string = str_replace(' ', '', $string);
        $array = explode(',', $string);
        return $array;
    }
}