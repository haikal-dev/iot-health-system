<?php

namespace App\Models;

class DataSchemeModel
{
    protected $data;
    protected $response;
    protected $status;

    public function __construct(){
        //
    }

    public function set($data){
        $this->data = $data;
    }

    public function success(){
        $this->status = true;
    }

    public function error($message){
        $this->status = false;
        $this->response = $message;
    }
}
