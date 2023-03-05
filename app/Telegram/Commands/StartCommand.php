<?php

namespace App\Telegram\Commands;

use App\Models\User;
use App\Telegram\Buttons\StartButton;

class StartCommand
{

    public static function handle($bot)
    {

        return \Closure::fromCallable(
            function (\TelegramBot\Api\Types\Message $message) use ($bot){


                /**
                 *
                 * @var $bot \TelegramBot\Api\Client | \TelegramBot\Api\BotApi
                 */



            try {
                $chatId = $message->getChat()->getId();

                $user = User::where('chat',$chatId)->first();
                if($user){
                    $bot->sendMessage($chatId,"User mavjud");

                }else{

                    User::create([
                        'chat'=>$chatId
                    ]);
                    $bot->sendMessage($chatId,"User yaratildi!");
                }
                $button= new StartButton();
                $bot->sendMessage($chatId, $button->message, "HTML", false, null, $button->get());


            } catch (Exception $exception) {

            }
        }

        );

    }
}
