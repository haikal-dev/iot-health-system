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
        return view('patients.register');
    }

    public function fetch_approved_lists(Request $request){
        $model = new PatientModel;

        if($request->has('data') && $request->data == 'approved'){
            return [
                'status' => true,
                'patients' => $model->lists(true)
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
