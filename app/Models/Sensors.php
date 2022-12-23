<?php

namespace App\Models;

use App\Models\HeartBeat;

class Sensors
{
    public static function heartbeat(){
        $model = new HeartBeat();
        return $model;
    }
}
