<?php

namespace App\Models;

use App\Models\HeartBeat;
use App\Models\WifiModel;
use App\Models\Temperature;

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

    public static function temperature(){
        $model = new Temperature();
        return $model;
    }

    public static function reset(){
        $heartbeat = new HeartBeat();
        $wifi = new WifiModel();
        $temp = new Temperature();

        if($heartbeat->reset()){
            $wifi->reset();
            $temp->reset();
            
            return true;
        }

        else {
            return false;
        }
    }
}
