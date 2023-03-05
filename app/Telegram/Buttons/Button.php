<?php

namespace App\Telegram\Buttons;

abstract class Button
{
    abstract public function get();
    abstract public function setMessage();

}
