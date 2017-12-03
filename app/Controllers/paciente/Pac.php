<?php

namespace App\Controllers\paciente;

class Pac{
    private $con;
    private $modelPac;

    function __construct(){
        $this->con = new \Config\Conexao();
        $this->modelPac = new \App\Models\paciente\Paciente();
    }

    function mostrarPaciente(){
        $mostrar = $this->modelPac->mostrarPaciente();
        return $mostrar;
    }
    function mostrarPaciente2(){
        $mostrar = $this->modelPac->mostrarPaciente2();
        if($mostrar['resultado'] == true){
            return $mostrar['info'];
        }else{
            return "Nada Encontrado";
        }

    }
    
    function selUmPac($cpf){
        $sel = $this->modelPac->selectPaciente($cpf);
        return $sel;
    }
}