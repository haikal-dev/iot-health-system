<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensors;

class APIController extends Controller
{
    public function fetchHeartbeat(Request $request){
        $data = Sensors::heartbeat()->simulate();

        return [
            'success' => true,
            'heartbeat' => $data
        ];
    }

    public function fetchWifi(Request $request){
        $data = Sensors::wifi()->get();

        return [
            'success' => true,
            'wifi' => $data
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
