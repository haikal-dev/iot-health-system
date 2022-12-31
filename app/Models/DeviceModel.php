<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DeviceModel
{
    protected $table = 'devices';

    protected $model = [];

    public function __construct(){
        //
    }

    public function get_serial_number($serial_number){
        $model = DB::table($this->table)->where('serial_number', $serial_number)->first();

        if(isset($model->id)){
            $this->model = $model;
        }
    }

    public function hasPairing(){
        if(isset($this->model->pairing_id) && $this->model->pairing_id != ''){
            return true;
        }

        else {
            return false;
        }
    }

    public function get_pairing_id(){
        return $this->model->pairing_id;
    }

    public function reset_pairing($id){
        return DB::table($this->table)->where('id', $id)->update([
            'pairing_id' => '',
            'last_updated' => time()
        ]);
    }

    public function pairing($id, $pairing_id){
        return DB::table($this->table)->where('id', $id)->update([
            'pairing_id' => $pairing_id,
            'last_updated' => time()
        ]);
    }

    public function lists(){
        return DB::table($this->table)->orderBy('last_updated', 'desc')->get();
    }

    public function get_one($id){
        return DB::table($this->table)->where('id', $id)->first();
    }
}
