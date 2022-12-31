<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegramAPIController;

class TelegramController
{
    public static function message($msg){
        $bot = new TelegramAPIController;
        $bot->setChatId(env('TELEGRAM_ID'));
        $bot->setRobot(env('TELEGRAM_BOT'));
        $bot->text($msg);
        
        return $bot;
    }

    public static function reply($id, $msg){
        $bot = new TelegramAPIController;
        $bot->setChatId($id);
        $bot->setRobot(env('TELEGRAM_BOT'));
        $bot->text($msg);
        
        return $bot;
    }
}