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
        if (Utils::isFilePath($argv)) $this->readCsvFile($argv);
        else                          $this->readStrings($argv);
        $this->shuffle();
    }

    /**
     * CSVファイルを読み込む
     *
     * @param $filePath
     */
    private function readCsvFile($filePath)
    {
        $names = Utils::csvToArray($filePath);
        $names = Utils::arrayCollapse($names);
        $this->names = $names;
    }

    /**
     * 文字列を読み込む
     *
     * @param $argv
     */
    private function readStrings($argv)
    {
        $this->names = Utils::stringToArray($argv);
    }

    /**
     * シャッフル
     */
    private function shuffle()
    {
        $this->names = Utils::fisherYatesShuffle($this->names);
    }

    /**
     * 結果の表示
     */
    public function display()
    {
        foreach ($this->names as $index => $name) {
            echo "\033[0;32m" . ($index + 1) . ": $name\033[0m\n";
        }
    }
}