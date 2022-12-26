<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;

class PatientController extends Controller
{
    public function index(Request $request){
        $sidebar = new SidebarController();
        $sidebar->index('patients');

        return view('patients.index')
            ->with('sidebar', $sidebar->render());
    }
}
