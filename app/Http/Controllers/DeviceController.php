<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;
use App\Models\DeviceModel;
use App\Models\PatientModel;

class DeviceController extends Controller
{
    public function index(Request $request){
        $sidebar = new SidebarController();
        $sidebar->index('devices');
        return view('device.index')
            ->with('sidebar', $sidebar->render());
    }

    public function pairing(Request $request, $id){
        $device = new DeviceModel();
        
        if(!$request->has('pairing_id')){
            return [
                'status' => false,
                'response' => 'Invalid pairing ID'
            ];
        }

        else {
            if($request->pairing_id == ''){
                $device->reset_pairing($id);
            }

            else {
                $device->pairing($id, $request->pairing_id);
            }

            return [
                'status' => true
            ];
        }
    }

    public function fetch_device_lists(Request $request){
        $device = new DeviceModel();
        $patient = new PatientModel;
        $device = $device->lists();

        $data = [];

        foreach($device as $dev){
            if($dev->pairing_id != ''){
                $k = $patient->get_one($dev->pairing_id);
                if(isset($k->name)){
                    $dev->pairing_id = strtoupper($k->name);
                }

                else {
                    $dev->pairing_id = 'deleted';
                }
            }
            $dev->last_updated = gmdate('d/m/Y H:i', $dev->last_updated + (3600*8));
            $data[] = $dev;
        }

        return [
            'devices' => $data
        ];
    }

    public function fetch_device_id(Request $request, $id){
        $device = new DeviceModel();
        $result = $device->get_one($id);

        if(isset($result->id)){
            return [
                'status' => true,
                'device' => $device->get_one($id)
            ];
        }

        else {
            return [
                'status' => false,
                'response' => 'No device is available'
            ];
        }

        
    }
}
