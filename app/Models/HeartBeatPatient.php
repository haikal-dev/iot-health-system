<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\TimeAgo;

class HeartBeatPatient
{
    // table
    protected $table = 'hb_spo2';

    protected $patient_id;

    public function __construct(){
        //
    }

    public function get_patient_id($patient_id){
        $this->patient_id = $patient_id;
    }

    public function remove(){
        return DB::table($this->table)->where('patient_id', $this->patient_id)->delete();
    }

    public function save($hr, $spo){
        return DB::table($this->table)->insert([
            'patient_id' => $this->patient_id,
            'hr' => $hr,
            'spo' => $spo,
            'created_at' => time()
        ]);
    }

    public function chart(){
        $data = [];

        $model = DB::table($this->table)->where('patient_id', $this->patient_id)->select(DB::raw('count(*) as total'))->first();

        if($model->total > 10){
            $skipped = $model->total - 10;
            $data = DB::table($this->table)->where('patient_id', $this->patient_id)->skip($skipped)->take(10)->get();
        }

        else {
            $data = DB::table($this->table)->where('patient_id', $this->patient_id)->get();
        }
        
        return $data;
    }
}