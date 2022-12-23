<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegramAPIController;

class TelegramController
{
    protected static $chatId = '495215238';
    protected static $robotId = '5983822956:AAHVJxpwdfQdy-Vx-8WrGen-y_J4-fu0k5A';

    // development bot
    // protected static $chatId = '495913083';
    // protected static $robotId = '1856574595:AAF4sAkhwscWJOimZAKIbhDyC4dlgOJKCYA';

    public static function message($msg){
        $bot = new TelegramAPIController;
        $bot->setChatId(self::$chatId);
        $bot->setRobot(self::$robotId);
        $bot->text($msg);
        
        return $bot;
    }
}
