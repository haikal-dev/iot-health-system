<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DeviceModel
{
    protected $table = 'devices';

    public function __construct(){
        //
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
