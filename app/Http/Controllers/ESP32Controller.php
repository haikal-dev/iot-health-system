<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController as TG;

class ESP32Controller extends Controller
{
    public function index(Request $request){
        if(!$request->has('code')){
            return 'error';
        }

        else {
            $code = $request->code;
            $data = $request->has('data') ? $request->data : '';

            if($code == 'WIFI_STATUS'){
                TG::message("Device has been connected to Internet with IP: " . $data)->send();
            }

            elseif($code == 'HEARTBEAT'){
                if($data == 'READY'){
                    TG::message('Sensor is ready. Place your index finger on the sensor with steady pressure.')->send();
                }
            }

            elseif($code == 'CHECK'){
                if($request->has('hr')){
                    $heartrate = $request->hr;

                    TG::message('Heartbeat Rate: ' . $heartrate)->send();
                }
            }
            
            return 'received';
        }
    }
}
