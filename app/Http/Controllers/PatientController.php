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

    public function register(Request $request){
        return view('patients.register');
    }

    public function fetch_approved_lists(Request $request){
        $model = new PatientModel;

        return [
            'status' => true,
            'patients' => $model->lists(false)
        ];
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
