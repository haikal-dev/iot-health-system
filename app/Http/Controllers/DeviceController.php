<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;

class DeviceController extends Controller
{
    public function index(Request $request){
        $sidebar = new SidebarController();
        $sidebar->index('devices');
        return view('device.index')
            ->with('sidebar', $sidebar->render());
    }
}
