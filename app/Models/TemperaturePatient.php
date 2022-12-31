<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class TemperaturePatient
{
    protected $table = 'temperature';
    
    protected $patient_id;

    public function __construct(){
        //
    }

    public function get_patient_id($patient_id){
        $this->patient_id = $patient_id;
    }

    public function save($temp){
        return DB::table($this->table)->insert([
            'patient_id' => $this->patient_id,
            'temp' => $temp,
            'created_at' => time()
        ]);
    }
}
