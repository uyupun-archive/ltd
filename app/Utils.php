<?php

namespace App;

/**
 * Class Utils
 * @package App
 */
class Utils
{
    /**
     * 緑色文字の出力
     *
     * @param $text
     */
    public static function echoGreen($text)
    {
        echo "\r\033[0;32m$text\033[0m";
    }

    /**
     * 緑色文字の出力(改行)
     *
     * @param $text
     */
    public static function echoGreenLn($text)
    {
        echo "\r\033[0;32m$text\033[0m" . PHP_EOL;
    }

    /**
     * 緑色文字の出力(前の出力を上書きする)
     *
     * @param $text
     */
    public static function echoGreenOverride($text)
    {
        $pad = "     \x08\x08\x08\x08\x08";
        echo "\r\033[0;32m$text\033[0m$pad";
    }

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
     * ファイルが存在するか
     *
     * @param $filePath
     * @return bool
     */
    public static function existsFile($filePath)
    {
        if (file_exists($filePath)) return true;
        return false;
    }

    /**
     * @param $filePath
     * @return bool
     */
    public static function isCsvFile($filePath)
    {
        if (mime_content_type($filePath) === 'text/plain') return true;
        return false;
    }

    /**
     * CSVファイルを配列に変換する
     *
     * @param $filePath
     * @return array
     */
    public static function csvToArray($filePath)
    {
        if (!Utils::existsFile($filePath)) return [];
        if (!Utils::isCsvFile($filePath)) return [];

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