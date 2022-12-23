<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\TimeAgo;

class HeartBeat
{
    // table
    protected $table = 'heartbeat_sensors';

    public function __construct(){
        //
    }

    public function save($data){
        return DB::table($this->table)->insert([
            'sensor_value' => $data,
            'created_at' => time()
        ]);
    }

    public function reset(){
        return DB::table($this->table)->delete();
    }

    public function simulate(){
        $data = DB::table($this->table)->orderBy('created_at', 'DESC')->take(2)->get();
        return $this->analysis($data);
    }

    public function analysis($data){
        $model = [];

        if(count($data) == 2){
            $model['id'] = $data[0]->id;
            $model['value'] = $data[0]->sensor_value;
            $model['created_at'] = TimeAgo::set('@'.$data[0]->created_at);
            $model['graph'] = $this->calculate_percentage($data[0]->sensor_value, $data[1]->sensor_value);
            // $model['raw'] = $data;
        }

        else {
            $model['id'] = 0;
            $model['value'] = 0;
            $model['created_at'] = 0;
            $model['graph'] = 0;
            // $model['raw'] = 0;
        }
        return $model;
    }

    public function calculate_percentage($value1, $value2){
       $status = $value1 > $value2 ? 'increase' : 'decrease';
       return [
        'status' => $status,
        'percent' => number_format(($value1 > $value2 ? ($value1-$value2)/$value2 : ($value2-$value1)/$value2) * 100, 1)
       ];
    }
}