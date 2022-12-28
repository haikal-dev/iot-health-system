<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DeviceModel
{
    protected $table = 'devices';

    public function __construct(){
        //
    }

    public function lists(){
        return DB::table($this->table)->orderBy('last_updated', 'desc')->get();
    }

    public function get_one($id){
        return DB::table($this->table)->where('id', $id)->first();
    }
}
