<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class PatientModel
{
    protected $table = 'patients';

    protected $name;
    protected $age;
    protected $ic_no;
    protected $hp_no;
    protected $address;
    protected $diabetes;
    protected $hbpressure;
    protected $asthma;
    protected $do_operation;
    protected $other_diseases;
    protected $is_approved;
    protected $registered_at;

    public function __construct($name = '', $age = '', $ic_no = '', $hp_no = '', $address = '', $diabetes = '', $hbpressure = '', $asthma = '', $do_operation = '', $other_diseases = '', $is_approved = '', $registered_at = ''){
        $this->name = $name;
        $this->age = $age;
        $this->ic_no = $ic_no;
        $this->hp_no = $hp_no;
        $this->address = $address;
        $this->diabetes = $diabetes;
        $this->hbpressure = $hbpressure;
        $this->asthma = $asthma;
        $this->do_operation = $do_operation;
        $this->other_diseases = $other_diseases;
        $this->is_approved = $is_approved;
        $this->registered_at = $registered_at;
    }

    public function create(){
        return DB::table($this->table)->insert([
            'name' => $this->name,
            'age' => $this->age,
            'ic_no' => $this->ic_no,
            'hp_no' => $this->hp_no,
            'address' => $this->address,
            'diabetes' => $this->diabetes,
            'hbpressure' => $this->hbpressure,
            'asthma' => $this->asthma,
            'do_operation' => $this->do_operation,
            'other_diseases' => $this->other_diseases,
            'is_approved' => $this->is_approved,
            'registered_at' => $this->registered_at
        ]);
    }

    public function lists($approved = false){
        $data = [];
        
        if($approved){
            $data = DB::table($this->table)->where('is_approved', '1')->orderBy('registered_at', 'desc')->get();
        }

        else {
            $data = DB::table($this->table)->where('is_approved', '0')->orderBy('registered_at', 'desc')->get();
        }

        return $this->serialize($data);
    }

    public function serialize($data){
        $k = [];
        foreach($data as $arr){
            $arr->registered_at = gmdate('d/m/Y H:i', $arr->registered_at + (3600*8));
            $k[] = $arr;
        }

        return $k;
    }
}