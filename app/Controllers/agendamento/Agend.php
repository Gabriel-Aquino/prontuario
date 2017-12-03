<?php

namespace App\Controllers\agendamento;

    class Agend{
        private $con;
        private $modelAgend;

        function __construct(){
            $this->con = new \Config\Conexao();
            $this->modelAgend = new \App\Models\agendamento\Agendamento();
        }

        function MostrarAgend(){
            $set = $this->modelAgend->mostrarAgend();
            return $set;
        }

        function SelUmAgend($cod){
            $sel = $this->modelAgend->selectAgend($cod);
            return $sel;
        }

        function selAgendMed($crm){
            $sel = $this->modelAgend->selAgendMed($crm);
            return $sel;
        }

        function selAll($cpf){
            $sel = $this->modelAgend->selAll($cpf);
            return $sel;
        }
    }
