<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class SidebarController
{
    protected $data;
    public function __construct(){
        $this->data = [
            'dashboard' => [
                'icon' => 'bx bx-home-circle',
                'href' => '/',
                'title' => 'Dashboard',
                'active' => false
            ],
            // 'patients' => [
            //     'icon' => 'bx bx-first-aid',
            //     'href' => '/patients',
            //     'title' => 'Patients',
            //     'active' => false
            // ],
            'logout' => [
                'icon' => 'bx bx-log-out',
                'href' => '/logout',
                'title' => 'Logout',
                'active' => false
            ]
        ];
    }

    public function index($menu){
        $this->data[$menu]['active'] = true;
    }

    public function render(){
        return $this->data;
    }
}
