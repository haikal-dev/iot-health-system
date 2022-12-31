<?php

namespace App\Models;

use App\Models\HeartBeat;
use App\Models\WifiModel;
use App\Models\Temperature;
use App\Models\Charts;

use App\Models\PatientModel;
use App\Models\HeartBeatPatient;
use App\Models\TemperaturePatient;

class Sensors
{
    public static function heartbeat(){
        $model = new HeartBeat();
        return $model;
    }

    public static function Patient($patient_id){
        $heartbeat = new HeartBeatPatient();
        $temperature = new TemperaturePatient();
        $model = new PatientModel();
        $model->load_model($heartbeat, $temperature, $patient_id);

        return $model;
    }

    public static function charts($model){
        $chart = new Charts($model->all());
        return $chart;
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
