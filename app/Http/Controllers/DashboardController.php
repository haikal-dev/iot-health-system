<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController as TG;
use App\Http\Controllers\SidebarController;

class DashboardController extends Controller
{
    public function index(Request $request){
        // TG::message('dashboard is up!')->send();
        $sidebar = new SidebarController();
        $sidebar->index('dashboard');

        return view('dashboard.index')
            ->with('sidebar', $sidebar->render());
    }
}
