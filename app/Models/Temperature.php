<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Temperature
{
    protected $table = 'temp_sensors';
    
    public function __construct(){
        //
    }

    public function save($temp){
        return DB::table($this->table)->insert([
            'temp_value' => $temp,
            'created_at' => time()
        ]);
    }

    public function get(){
        $data = DB::table($this->table)->orderBy('created_at', 'desc')->first();

        if(isset($data->id)){
            return $data->temp_value;
        }

        else {
            return '0';
        }
        
    }

    public function reset(){
        return DB::table($this->table)->delete();
    }
}
