<?php

namespace App\Telegram\Callbacks;

use App\Models\User;
use App\Telegram\Buttons\Reply\StartButton;

class StartCallback
{
    public static function handle($bot,$query)
    {
        /**
         *
         * @var $bot \TelegramBot\Api\Client | \TelegramBot\Api\BotApi
         */
            try {

                $data = $query->getData();
                $messageId = $query->getMessage()->getMessageId();

                $button= new StartButton();

               $user_ids=User::pluck('name','id');
               var_dump($user_ids);
                $chatId = $query->getMessage()->getChat()->getId();
                var_dump($chatId);
                $bot->sendMessage($chatId,'salom');
                $bot->editMessageText($chatId, $messageId, 'salom   '.$button->message, "HTML", false, $button->get());

            } catch (Exception $exception) {


            }


    }

}
