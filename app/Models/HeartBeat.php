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

    public function save($hr, $spo){
        return DB::table($this->table)->insert([
            'sensor_value' => $hr,
            'spo_value' => $spo,
            'created_at' => time()
        ]);
    }

    public function all(){
        $data = [];

        $model = DB::table($this->table)->select(DB::raw('count(*) as total'))->first();

        if($model->total > 10){
            $skipped = $model->total - 10;
            $data = DB::table($this->table)->skip($skipped)->take(10)->get();
        }

        else {
            $data = DB::table($this->table)->get();
        }
        
        return $data;
    }

    public function reset(){
        return DB::table($this->table)->delete();
    }

    public function simulate(){
        $data = DB::table($this->table)->orderBy('created_at', 'DESC')->first();
        return $this->analysis($data);
    }

    public function analysis($data){
        $model = [];

        if(isset($data->id)){
            $model['id'] = $data->id;
            $model['hr'] = $data->sensor_value;
            $model['spo'] = $data->spo_value;
            $model['created_at'] = TimeAgo::set('@'.$data->created_at);
        }
        return $model;
    }

    // public function calculate_percentage($value1, $value2){
    //    $status = $value1 > $value2 ? 'increase' : 'decrease';
    //    return [
    //     'status' => $status,
    //     'percent' => number_format(($value1 > $value2 ? ($value1-$value2)/$value2 : ($value2-$value1)/$value2) * 100, 1)
    //    ];
    // }
}