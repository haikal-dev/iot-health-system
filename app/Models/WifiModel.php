<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\TimeAgo;

class WifiModel
{
    protected $table = 'wifi';

    public function __construct(){
        //
    }

    public function save($ssid, $ip){
        return DB::table($this->table)->insert([
            'ssid' => $ssid,
            'ip_address' => $ip,
            'created_at' => time()
        ]);
    }

    public function reset(){
        return DB::table($this->table)->delete();
    }

    public function get(){
        $data = DB::table($this->table)->orderBy('id', 'desc')->first();

        if(isset($data->id)){
            $data->created_at = TimeAgo::set('@' . $data->created_at);
            return $data;
        }

        return [];
    }
}
