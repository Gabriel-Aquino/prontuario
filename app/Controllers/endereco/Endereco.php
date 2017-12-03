<?php

namespace App\Controllers\endereco;

    class Endereco{
        private $con;
        private $modelEnd;

        function __construct(){
            $this->con = new \Config\Conexao();
            $this->modelEnd = new \App\Models\endereco\Endereco();
        }

        function selEstado(){
            $selEstado = $this->modelEnd->getEstado();
            if($selEstado['resultado'] == true){
                return $selEstado['info'];
            }else{
                return "Nada Encontrado";
            }
        }

        function selCidade(){
            $selCidade = $this->modelEnd->getCidade();
            if($selCidade['resultado'] == true){
                return $selCidade['info'];
            }else{
                return "Nada Encontrado";
            }
        }
    }