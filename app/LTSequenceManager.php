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
        if ($this->isFilePath($argv)) $names = $this->readCsvFile($argv);
        else                          $names = $this->readStrings($argv);
        $names = Utils::arrayCollapse($names);
        $this->names = $this->shuffle($names);
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

    /**
     * ファイルパスかどうか
     *
     * @param $argv
     * @return bool
     */
    private function isFilePath($argv)
    {
        if (strpos($argv, '/') === false) return false;
        return true;
    }

    /**
     * CSVファイルを読み込んで配列に変換する
     *
     * @param $filePath
     * @return array
     */
    private function readCsvFile($filePath)
    {
        $file = new \SplFileObject($filePath);
        $file->setFlags(\SplFileObject::READ_CSV);

        $records = [];
        foreach ($file as $line) {
            mb_convert_variables('UTF-8', ['ASCII', 'JIS', 'EUC-JP', 'SJIS'], $line[0]);
            $records[] = $line;
        }

        return $records;
    }

    /**
     * 文字列を配列に変換する
     *
     * @param $argv
     * @return array
     */
    private function readStrings($argv)
    {
        $names = str_replace(' ', '', $argv);
        $names = explode(',', $names);
        return $names;
    }

    /**
     * Fisher-Yates Shuffle
     *
     * @param $array
     * @return mixed
     */
    private function shuffle($array)
    {
        for ($i = count($array) - 1; $i > 0; $i--) {
            $r = mt_rand(0, $i);
            $tmp = $array[$i];
            $array[$i] = $array[$r];
            $array[$r] = $tmp;
        }

        return $array;
    }
}