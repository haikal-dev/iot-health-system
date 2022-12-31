<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;
use App\Models\PatientModel;

class PatientController extends Controller
{
    public function index(Request $request){
        $sidebar = new SidebarController();
        $sidebar->index('patients');

        return view('patients.index')
            ->with('sidebar', $sidebar->render());
    }

    public function update(Request $request, $id){
        $model = new PatientModel;

        if($request->has('api')){
            if($request->api == 'approve'){
                $model->approve_patient($id);
                return [
                    'status' => true
                ];
            }

            elseif($request->api == 'update'){
                $model->update($id, [
                    'name' => $request->name,
                    'age' => $request->age,
                    'ic_no' => $request->ic_no,
                    'hp_no' => $request->hp_no,
                    'address' => $request->address,
                    'diabetes' => $request->diabetes,
                    'hbpressure' => $request->hbpressure,
                    'asthma' => $request->asthma,
                    'do_operation' => $request->do_operation,
                    'other_diseases' => $request->other_diseases
                ]);

                return [
                    'status' => true
                ];
            }
        }
    }

    public function fetch_patient_id(Request $request, $id){
        $model = new PatientModel;

        $result = $model->get_one($id);

        if(!isset($result->id)){
            return [
                'status' => false,
                'response' => 'Patient was not found'
            ];
        }

        else {
            return [
                'status' => true,
                'patient' => $result
            ];
        }
    }

    public function register(Request $request){
        if($request->has('id')){
            return view('patients.register')
                ->with('telegram_id', $request->id);
        }

        else {
            return response(['message' => 'invalid request'], 401);
        }
    }

    public function fetch_approved_lists(Request $request){
        $model = new PatientModel;

        if($request->has('data') && $request->data == 'approved'){
            return [
                'status' => true,
                'patients' => $model->lists(true)
            ];
        }

        elseif($request->has('data') && $request->data == 'approvedHasTelegram'){
            return [
                'status' => true,
                'patients' => $model->lists(true, true)
            ];
        }

        else {
            return [
                'status' => true,
                'patients' => $model->lists(false)
            ];
        }
    }

    public function create_patient(Request $request){
        $model = new PatientModel(
            $request->name,
            $request->telegram_id,
            $request->age,
            $request->ic_no,
            $request->hp_no,
            $request->address,
            $request->diabetes,
            $request->hbpressure,
            $request->asthma,
            $request->do_operation,
            $request->other_diseases,
            '0',
            time()
        );

        $result = $model->create();

        if($result){
            return [
                'status' => true
            ];
        }

        else {
            return [
                'status' => false,
                'response' => 'Unable to create a database for this patient'
            ];
        }
        
    }
}
