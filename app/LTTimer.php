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
        $second = $this->minutes;
        for ($i = $second; $i >= 0; --$i) {
            Utils::echoGreenOverride($i . ' seconds left');
            sleep(1);
        }
        Utils::echoGreenLn("\r----- KANKANKANKANKANKAN!!!!!!!!!!! -----");
    }
}