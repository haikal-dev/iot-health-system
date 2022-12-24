<?php

namespace App\Models;

class Charts
{
    protected $model;
    protected $data = [];

    public function __construct($model){
        $this->model = $model;
    }

    public function filterize($columns){

        foreach($columns as $column){
            $temp = [];
            foreach($this->model as $model){    
                
                $temp[] = $model->$column;
            }

            $this->data[$column] = $temp;
        }

        return $this;
    }

    public function render(){
        return $this->data;
    }
}
