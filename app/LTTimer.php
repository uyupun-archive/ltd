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
     * @param int $minutes
     */
    public function __construct($minutes = 5)
    {
        $this->minutes = $minutes;
    }

    /**
     * カウントダウン
     */
    public function countdown()
    {
        $second = $this->minutes * 60;
        $pad = "     \x08\x08\x08\x08\x08";
        for ($i = $second; $i >= 0; --$i) {
            echo "\r\033[0;32m" . $i . ' seconds left' . "\033[0m" . $pad;
            sleep(1);
        }
        echo "\r\033[0;32m" . '----- KANKANKANKANKANKAN!!!!!!!!!!! -----' . "\033[0m" . PHP_EOL;
    }
}