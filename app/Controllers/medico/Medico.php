<?php

namespace App\Controllers\medico;

class Medico{
    private $con;
    private $post;
    private $modelMed;

    function __construct($post){
        $this->con = new \Config\Conexao();
        $this->modelMed = new \App\Models\medico\Medico();
        $this->post = $post;
    }

    function Validar(){
        $validar = new \Valitron\Validator($this->post);

        $validar->rule('required', array('nome', 'crm', 'tel', 'email',
        'dtn', 'rg'))->message('{field} é obrigatório');
        if($validar->validate()){
            return $validar->errors();
        }else{
            return $validar->errors();
        }
    }

    function insertMedico(){
        $insert = $this->modelMed->criarMedico($this->post);
       
        if($insert['feedback'] == true){
            return true;
        }else{
            return false;
        }
    }

    function delMedico(){
        $del = $this->modelMed->delMedico($this->post);
        return $del;
    }
    function updateMedico(){
        $update = $this->modelMed->updateMedico($this->post);
        return $update;
    }
}
