<?php

namespace App\Telegram\Buttons;

use App\Models\Category;

class StartButton
{
    public $message;

    public function __construct()
    {
        $this->message = "<b>🇺🇿 Iltimos tilni tanlang!\n\n🇬🇧 Please! choose a language!\n\n🇷🇺 Пожалуйста, выберите язык!</b>";
    }

    public function get()
    {

        $keyboard = [];
        foreach (array_chunk(['🇺🇿 Uzbek','🇬🇧 English','🇷🇺 Russkiy'], 2) as $key => $categories) {
            $row = [];
            foreach ($categories as $id => $category) {

                $row[] = [
                    'text' => $category,

                ];


            }
            $keyboard[]=$row;
        }
        return new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            $keyboard,null,true);
    }
}
