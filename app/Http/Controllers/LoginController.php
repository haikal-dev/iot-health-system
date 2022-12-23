<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController as TG;

class LoginController extends Controller
{
    public function index(Request $request){
        return view('login');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

    public function token_request(Request $request){
        $token = rand(123456, 987654);

        $request->session()->put('login_token', $token);

        TG::message('Your token access is: ' . $token)->send();

        return [
            'success' => true
        ];
    }

    public function login(Request $request){
        if(!$request->session()->has('login_token')){
            return [
                'success' => false,
                'response' => 'Token was not requested yet.'
            ];
        }

        else {
            if(!$request->has('token')){
                return [
                    'success' => false,
                    'response' => 'Invalid request.'
                ];
            }

            else {
                if($request->token == $request->session()->get('login_token')){
                    $request->session()->forget('login_token');
                    $request->session()->put('isAuth', time());

                    return [
                        'success' => true
                    ];
                }

                else {
                    $request->session()->forget('login_token');
                    return [
                        'success' => false,
                        'response' => 'Invalid token.'
                    ];
                }
            }
        }
    }
}
