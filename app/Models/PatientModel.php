<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TelegramController as Telegram;

class PatientModel
{
    protected $table = 'patients';

    protected $name;
    protected $telegram_id;
    protected $ic_no;
    protected $hp_no;
    protected $address;
    protected $diabetes;
    protected $hbpressure;
    protected $asthma;
    protected $do_operation;
    protected $fever;
    protected $cough;
    protected $shortness_breath;
    protected $fatique;
    protected $body_aches;
    protected $loss_taste;
    protected $sore_throats;
    protected $diarrhea;
    protected $nausea_vomitting;
    protected $day_sick;
    protected $heart_diseases;
    protected $other_diseases;
    protected $is_approved;
    protected $registered_at;
    protected $userid;

    protected $heartbeat;
    protected $temperature;

    public function __construct(
            $name = '', 
            $telegram_id = '',
            $ic_no = '', 
            $hp_no = '', 
            $address = '', 
            $diabetes = '', 
            $hbpressure = '', 
            $asthma = '', 
            $do_operation = '', 
            $fever = '', 
            $cough = '', 
            $shortness_breath = '', 
            $fatique = '', 
            $body_aches = '', 
            $loss_taste = '', 
            $sore_throats = '', 
            $diarrhea = '', 
            $nausea_vomitting = '', 
            $day_sick = '', 
            $heart_diseases = '', 
            $other_diseases = '', 
            $is_approved = '', 
            $registered_at = ''
        ){
        
        $this->name = $name;
        $this->telegram_id = $telegram_id;
        $this->ic_no = $ic_no;
        $this->hp_no = $hp_no;
        $this->address = $address;
        $this->diabetes = $diabetes;
        $this->hbpressure = $hbpressure;
        $this->asthma = $asthma;
        $this->do_operation = $do_operation;
        $this->fever = $fever;
        $this->cough = $cough;
        $this->shortness_breath = $shortness_breath;
        $this->fatique = $fatique;
        $this->body_aches = $body_aches;
        $this->loss_taste = $loss_taste;
        $this->sore_throats = $sore_throats;
        $this->diarrhea = $diarrhea;
        $this->nausea_vomitting = $nausea_vomitting;
        $this->day_sick = $day_sick;
        $this->heart_diseases = $heart_diseases;
        $this->other_diseases = $other_diseases;
        $this->is_approved = $is_approved;
        $this->registered_at = $registered_at;
    }

    public function removeAll(){
        $this->heartbeat()->remove();
        $this->temperature()->remove();
        $this->remove();
    }

    public function remove(){
        return DB::table($this->table)->where('id', $this->userid)->delete();
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
            'ic_no' => $this->ic_no,
            'hp_no' => $this->hp_no,
            'address' => $this->address,
            'diabetes' => $this->diabetes,
            'hbpressure' => $this->hbpressure,
            'asthma' => $this->asthma,
            'do_operation' => $this->do_operation,
            'fever' => $this->fever,
            'cough' => $this->cough,
            'shortness_breath' => $this->shortness_breath,
            'fatique' => $this->fatique,
            'body_aches' => $this->body_aches,
            'loss_taste' => $this->loss_taste,
            'sore_throats' => $this->sore_throats,
            'diarrhea' => $this->diarrhea,
            'nausea_vomitting' => $this->nausea_vomitting,
            'day_sick' => $this->day_sick,
            'heart_diseases' => $this->heart_diseases,
            'other_diseases' => $this->other_diseases,
            'is_approved' => $this->is_approved,
            'registered_at' => $this->registered_at
        ]);
    }
    public function update($id, $data){
        return DB::table($this->table)->where('id', $id)->update([
            'name' => $data['name'],
            'telegram_id' => $data['telegram_id'],
            'ic_no' => $data['ic_no'],
            'hp_no' => $data['hp_no'],
            'address' => $data['address'],
            'diabetes' => $data['diabetes'],
            'hbpressure' => $data['hbpressure'],
            'asthma' => $data['asthma'],
            'do_operation' => $data['do_operation'],
            'fever' => $data['fever'],
            'cough' => $data['cough'],
            'shortness_breath' => $data['shortness_breath'],
            'fatique' => $data['fatique'],
            'body_aches' => $data['body_aches'],
            'loss_taste' => $data['loss_taste'],
            'sore_throats' => $data['sore_throats'],
            'diarrhea' => $data['diarrhea'],
            'nausea_vomitting' => $data['nausea_vomitting'],
            'day_sick' => $data['day_sick'],
            'heart_diseases' => $data['heart_diseases'],
            'other_diseases' => $data['other_diseases']
        ]);
    }

    public function lists($approved = false, $hasTelegram = false){
        $data = [];
        
        if($approved && !$hasTelegram){
            $data = DB::table($this->table)->where('is_approved', '1')->orderBy('registered_at', 'desc')->get();
        }

        elseif($approved && $hasTelegram){
            $pre_model = DB::table($this->table)->where('is_approved', '1')->orderBy('registered_at', 'desc')->get();

            foreach($pre_model as $model){
                if($model->telegram_id != ''){
                    $data[] = $model;
                }
            }
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

    public function get_age($ic_no){
        if(strlen($ic_no) == 12){
            $current_year = gmdate('Y', time());
            $age = 0;
    
            preg_match('/^\d{2}/', $ic_no, $matches);
            preg_match('/\d{2}$/', $current_year, $limiter);
    
            if($matches[0] > $limiter[0]){
                $year = 1900 + $matches[0];    
                $age = $current_year - $year;
            }
    
            else {
                $year = 2000 + $matches[0];
                $age = $current_year - $year;
            }

            return $age;
        }

        else {
            return 0;
        }
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
