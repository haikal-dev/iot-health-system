<?php

namespace App\Models;

use App\Models\HeartBeat;
use App\Models\WifiModel;

class Sensors
{
    public static function heartbeat(){
        $model = new HeartBeat();
        return $model;
    }

    public static function wifi(){
        $model = new WifiModel();
        return $model;
    }
}
