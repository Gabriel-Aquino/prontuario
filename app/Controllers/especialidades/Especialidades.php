<?php

namespace App\Controllers\especialidades;

    class Especialidades{
        private $con;
        private $modelEsp;

        function __construct(){
            $this->con = new \Config\Conexao();
            $this->modelEsp = new \App\Models\especialidades\Especialidades();
        }

        function selAllEsp(){
            $esp = $this->modelEsp->getEspecialidades();
            if($esp['resultado'] == true){
                return $esp['info'];
            }else{
                return "Nada Encontrado";
            }
        }
    }