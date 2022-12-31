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

    public function save($hr, $spo){
        return DB::table($this->table)->insert([
            'patient_id' => $this->patient_id,
            'hr' => $hr,
            'spo' => $spo,
            'created_at' => time()
        ]);
    }
}