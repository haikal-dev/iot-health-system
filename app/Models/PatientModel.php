<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TelegramController as Telegram;

class PatientModel
{
    protected $table = 'patients';

    protected $name;
    protected $telegram_id;
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
    protected $userid;

    protected $heartbeat;
    protected $temperature;

    public function __construct($name = '', $telegram_id = '', $age = '', $ic_no = '', $hp_no = '', $address = '', $diabetes = '', $hbpressure = '', $asthma = '', $do_operation = '', $other_diseases = '', $is_approved = '', $registered_at = ''){
        $this->name = $name;
        $this->telegram_id = $telegram_id;
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

    public function load_model($hb, $temp, $userid){
        $this->heartbeat = $hb;
        $this->temperature = $temp;
        $this->userid = $userid;
    }

    public function heartbeat(){
        $this->heartbeat->get_patient_id($this->userid);
        return $this->heartbeat;
    }

    public function temperature(){
        $this->temperature->get_patient_id($this->userid);
        return $this->temperature;
    }

    public function create(){
        return DB::table($this->table)->insert([
            'name' => $this->name,
            'telegram_id' => $this->telegram_id,
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
    public function update($id, $data){
        return DB::table($this->table)->where('id', $id)->update([
            'name' => $data['name'],
            'telegram_id' => $data['telegram_id'],
            'age' => $data['age'],
            'ic_no' => $data['ic_no'],
            'hp_no' => $data['hp_no'],
            'address' => $data['address'],
            'diabetes' => $data['diabetes'],
            'hbpressure' => $data['hbpressure'],
            'asthma' => $data['asthma'],
            'do_operation' => $data['do_operation'],
            'other_diseases' => $data['other_diseases']
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

    public function approve_patient($id){
        $model = DB::table($this->table)->where('id', $id)->first();

        if(isset($model->telegram_id)){
            Telegram::reply($model->telegram_id, 'Your account has been approved by doctor.')->send();

            return DB::table($this->table)->where('id', $id)->update([
                'is_approved' => 1
            ]);
        }
    }

    public function get_one($id){
        return DB::table($this->table)->where('id', $id)->first();
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
