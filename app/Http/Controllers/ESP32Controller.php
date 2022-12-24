<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController as TG;
use App\Models\Sensors;

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
                $ip = $request->has('ip') ? $request->ip : '';
                $ssid = $request->has('ssid') ? $request->ssid : '';

                if($ssid == '' || $ip == ''){
                    // dont send
                }
                else {
                    Sensors::wifi()->save($ssid, $ip);
                    TG::message("Device has been connected to Internet with IP: " . $ip)->send();
                }
            }

            elseif($code == 'HEARTBEAT'){
                if($data == 'READY'){
                    TG::message('Sensor is ready. Place your index finger on the sensor with steady pressure.')->send();
                }
            }

            elseif($code == 'TEMP'){
                if($request->has('temp')){
                    $temp = $request->temp;

                    Sensors::temperature()->save($temp);
                    TG::message('Temperature is recorded. Temp: ' . $temp)->send();
                }
            }

            elseif($code == 'CHECK'){
                if($request->has('hr', 'spo')){
                    $hr = $request->hr;
                    $spo = $request->spo;

                    Sensors::heartbeat()->save($hr, $spo);
                    TG::message('Heartbeat Rate: ' . $hr)->send();
                }
            }
            
            return 'received';
        }
    }
}
