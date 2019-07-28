<?php

namespace App;

/**
 * Class LTSequenceManager
 * @package App
 */
class LTSequenceManager
{
    private $names = [];

    /**
     * LTSequenceManager constructor.
     * @param $argv
     */
    public function __construct($argv)
    {
        if (Utils::isFilePath($argv)) $names = $this->readCsvFile($argv);
        else                          $names = $this->readStrings($argv);
        $this->names = $this->shuffle($names);
    }

    /**
     * CSVファイルを読み込む
     *
     * @param $filePath
     * @return array
     */
    private function readCsvFile($filePath)
    {
        $names = Utils::csvToArray($filePath);
        $names = Utils::arrayCollapse($names);
        return $names;
    }

    /**
     * 文字列を読み込む
     *
     * @param $argv
     * @return array
     */
    private function readStrings($argv)
    {
        return Utils::stringToArray($argv);
    }

    /**
     * シャッフル
     *
     * @param $names
     * @return mixed
     */
    private function shuffle($names)
    {
        return Utils::fisherYatesShuffle($names);
    }

    /**
     * 結果の表示
     */
    public function display()
    {
        foreach ($this->names as $index => $name) {
            Utils::echoGreen(($index + 1) . ": $name" . PHP_EOL);
        }
    }
}