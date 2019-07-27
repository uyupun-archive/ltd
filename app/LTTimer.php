<?php

namespace App;

/**
 * Class LTTimer
 * @package App
 */
class LTTimer
{
    protected $minutes;

    /**
     * LTTimer constructor.
     * @param int $argv
     */
    public function __construct($argv = 5)
    {
        $this->minutes = $argv;
    }

    /**
     * カウントダウン
     */
    public function countdown()
    {
        $second = $this->minutes;
        for ($i = $second; $i >= 0; --$i) {
            echo "\r\033[0;32m" . $i . " seconds left     " . "\033[0m";
            sleep(1);
        }
        echo "\r\033[0;32m" . '----- KANKANKANKANKANKAN!!!!!!!!!!! -----' . "\033[0m" . PHP_EOL;
    }
}