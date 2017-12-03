<?php

namespace App\Controllers\medico;

class Med{
    private $con;
    private $ModelMed;

    function __construct(){
        $this->con = new \Config\Conexao();
        $this->modelMed = new \App\Models\medico\Medico();
    }

    function mostrarMedico(){
        $mostrar = $this->modelMed->mostrarMedico();
        return $mostrar;
    }
    function mostrarMedico2(){
        $mostrar = $this->modelMed->mostrarMedico2();
        if($mostrar['resultado'] == true){
            return $mostrar['info'];
        }else{
            return "Nada Encontrado";
        }
    }
    
    function selUmMed($crm){
        $sel = $this->modelMed->selectMedico($crm);
        return $sel;
    }
}