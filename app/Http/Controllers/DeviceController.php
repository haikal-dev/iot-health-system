<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;
use App\Models\DeviceModel;

class DeviceController extends Controller
{
    public function index(Request $request){
        $sidebar = new SidebarController();
        $sidebar->index('devices');
        return view('device.index')
            ->with('sidebar', $sidebar->render());
    }

    public function fetch_device_lists(Request $request){
        $device = new DeviceModel();

        return [
            'devices' => $device->lists()
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
