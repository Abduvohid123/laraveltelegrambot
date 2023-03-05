<?php

namespace App\Telegram\Commands;

use App\Models\User;
use App\Telegram\Buttons\Reply\StartButton;


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
                if(!$user){
                  $user=  User::create([
                        'chat'=>$chatId
                    ]);
                }


                if ($user->lang){


//                    $bot->sendMessage($chatId, $button->message, "HTML", false, null, $button->get());

                }else{
//                   $button = new StartButton();
//                   var_dump($button);
                    $bot->sendMessage($chatId, "salom", "HTML", false, null);

                }


            } catch (Exception $exception) {

            }
        }

        );

    }
}
