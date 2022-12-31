<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController as TG;
use App\Models\Sensors;
use App\Models\DeviceModel;
use App\Models\PatientModel;

class ESP32Controller extends Controller
{
    public function index(Request $request){
        if(!$request->has('code')){
            return 'error';
        }

        else {
            $code = $request->code;
            $data = $request->has('data') ? $request->data : '';
            $serial_number = 'MLX90614/MAX30102';

            $device = new DeviceModel();
            $device->get_serial_number($serial_number);
            $patient = new PatientModel();
            

            if($code == 'WIFI_STATUS'){
                $ip = $request->has('ip') ? $request->ip : '';
                $ssid = $request->has('ssid') ? $request->ssid : '';

                if($ssid == '' || $ip == ''){
                    // dont send
                }
                else {
                    Sensors::wifi()->save($ssid, $ip);

                    if($device->hasPairing()){
                        $patient = $patient->get_one($device->get_pairing_id());
                        TG::reply($patient->telegram_id, "Device has been connected to Internet with IP: " . $ip)->send();
                    }
                }
            }

            elseif($code == 'HEARTBEAT'){
                if($data == 'READY'){
                    if($device->hasPairing()){
                        $patient = $patient->get_one($device->get_pairing_id());
                        TG::reply($patient->telegram_id, 'Sensor is ready. Place your index finger on the sensor with steady pressure.')->send();
                    }
                }
            }

            elseif($code == 'TEMP'){
                if($request->has('temp')){
                    $temp = $request->temp;

                    if(!$device->hasPairing()){
                        Sensors::temperature()->save($temp);
                    }

                    else {
                        $patient = $patient->get_one($device->get_pairing_id());
                        Sensors::Patient($patient->id)->temperature()->save($temp);
                        TG::reply($patient->telegram_id, "Temperature is recorded. Temp: " . $temp)->send();
                    }
                }
            }

            elseif($code == 'CHECK'){
                if($request->has('hr', 'spo')){
                    $hr = $request->hr;
                    $spo = $request->spo;

                    if(!$device->hasPairing()){
                        Sensors::heartbeat()->save($hr, $spo);
                    }

                    else {
                        $patient = $patient->get_one($device->get_pairing_id());
                        Sensors::Patient($patient->id)->heartbeat()->save($hr, $spo);
                        TG::reply($patient->telegram_id, "Heartbeat Rate: " . $hr . "\nSPO2: " . $spo)->send();
                    }
                }
            }
            
            return 'received';
        }
    }
}
