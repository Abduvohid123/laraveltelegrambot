<?php

namespace App\Telegram\Buttons\Reply;

class BackButton
{
    public $message;

    public function __construct($message)
    {
        if($message){

            $this->message = $message;
        }
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
            $keyboard,true,true);
    }
}
