<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensors;
use App\Http\Controllers\TelegramController as TG;

class APIController extends Controller
{
    public function fetchHeartbeat(Request $request){
        $data = Sensors::heartbeat()->simulate();

        return [
            'success' => true,
            'sensors' => $data
        ];
    }

    public function sendTelegram(Request $request){
        if($request->has('name', 'text', 'telegram_id')){
            TG::reply($request->telegram_id, "[RESPONSE FROM DOCTOR]\n\nDear " . $request->name . ",\n\n" . $request->text)->send();
            return [
                'status' => true
            ];
        }
    }

    public function fetchTemperatureByPatient(Request $request, $patient_id){
        $data = Sensors::charts(Sensors::Patient($patient_id)->temperature()->chart())
            ->filterize([
                'temp'
            ])
            ->render();

        $count = 0;
        foreach($data['temp'] as $k){
            $data['numbers'][] = $count;
            $count++;
        }

        return [
            'status' => true,
            'response' => $data
        ];
    }

    public function fetchHeartbeatByPatient(Request $request, $patient_id){
        $data = Sensors::charts(Sensors::Patient($patient_id)->heartbeat()->chart())
            ->filterize([
                'hr',
                'spo'
            ])
            ->render();

        $count = 0;
        foreach($data['hr'] as $k){
            $data['numbers'][] = $count;
            $count++;
        }

        return [
            'success' => true,
            'response' => $data
        ];
    }

    public function fetchHeartbeatChart(Request $request){
        $data = Sensors::charts(Sensors::heartbeat())
            ->filterize([
                'sensor_value',
                'spo_value'
             ])
            ->render();
        
        $count = 0;
        foreach($data['sensor_value'] as $k){
            $data['numbers'][] = $count;
            $count++;
        }

        return [
            'success' => true,
            'response' => $data
        ];
    }

    public function fetchWifi(Request $request){
        $data = Sensors::wifi()->get();

        return [
            'success' => true,
            'wifi' => $data
        ];
    }

    public function fetchTemp(Request $request){
        $data = Sensors::temperature()->get();

        return [
            'success' => true,
            'temp' => $data
        ];
    }

    public function resetInfo(Request $request){
        $data = Sensors::reset();

        if($data){
            return [
                'success' => true
            ];
        }

        else {
            return [
                'success' => false,
                'response' => 'Cant reset.'
            ];
        }
    }
}
