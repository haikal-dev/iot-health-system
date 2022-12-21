<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController as TG;

class DashboardController extends Controller
{
    public function index(Request $request){
        // TG::message('dashboard is up!')->send();
        return view('dashboard.index');
    }
}
