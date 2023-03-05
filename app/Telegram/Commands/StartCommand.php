<?php

namespace App\Telegram\Commands;

use App\Models\User;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;


class StartCommand
{

    public static function handle($bot)
    {

        return \Closure::fromCallable(
            function (\TelegramBot\Api\Types\Message $message) use ($bot) {


                /**
                 *
                 * @var $bot \TelegramBot\Api\Client | \TelegramBot\Api\BotApi
                 */


                try {
                    $chatId = $message->getChat()->getId();

                    $user = User::where('chat', $chatId)->first();


                    $back_massiv = ['Orqaga', 'Back', 'Nazad'];
                    $lang_messages = ['Keling tanishamiz!😁 Mening ismim Juju. Siznikichi?', "Let's meet!😁 My name is Juju. What is your name?", 'Меня зовут Джуджу. А вы?'];


                    if (!$user) {
                        $user = User::create([
                            'chat' => $chatId,
                            'status'=>'tillar'
                        ]);

                    }


                    if ($user->lang) {

                        if ($user->name) {

                        } else {

                            $back = $back_massiv[intval($user->lang)];
                            $keyboard = new ReplyKeyboardMarkup(['text' => $back], null, true);
                            $bot->sendMessage($chatId, $lang_messages[intval($user->lang)], 'HTML', false, null, null, $keyboard);
                        }


                    } else {

                        $keyboard = [];
                        foreach (array_chunk(['🇺🇿 Uzbek', '🇬🇧 English', '🇷🇺 Russkiy'], 2) as $key => $categories) {
                            $row = [];
                            foreach ($categories as $id => $category) {

                                $row[] = [
                                    'text' => $category,

                                ];


                            }
                            $keyboard[] = $row;
                        }
                        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                            $keyboard, true, true);
                        $bot->sendMessage($chatId, "<b>🇺🇿 Iltimos tilni tanlang!\n\n🇬🇧 Please! choose a language!\n\n🇷🇺 Пожалуйста, выберите язык!</b>", "HTML", false, null, $keyboard);

                    }


                } catch (Exception $exception) {

                }
            }

        );

    }
}
