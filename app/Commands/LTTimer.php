<?php

namespace App\Commands;

use App\Utils;

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
        for ($i = $second; $i >= 0; --$i) {
            Utils::echoGreenOverride($i . ' seconds left');
            sleep(1);
        }
        Utils::echoGreenOverrideLn("----- KANKANKANKANKANKAN!!!!!!!!!!! -----");
        Utils::beep();
    }
}