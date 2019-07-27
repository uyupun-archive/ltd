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
        $second = $this->minutes * 60;
        for ($i = 0; $i < $second; $i++) {
            echo "\r";
            echo "\033[0;32m" . '' . ($second - $i) . ' seconds left' . "\033[0m";
            sleep(1);
        }
        echo PHP_EOL;
    }
}