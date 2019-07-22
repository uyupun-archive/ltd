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
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $names = $this->readCsvFile($filePath);
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