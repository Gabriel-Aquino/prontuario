<?php

namespace App\Controllers\paciente;

    class Paciente{
        private $con;
        private $post;
        private $modelPac;

        function __construct($post){
            $this->post = $post;
            $this->con = new \Config\Conexao();
            $this->modelPac = new \App\Models\paciente\Paciente();
        }

        function Validar(){
            $validar = new \Valitron\Validator($this->post);
    
            $validar->rule('required', array('nome', 'cpf', 'rg', 'dtn'
            ))->message('{field} é obrigatório');
            if($validar->validate()){
                return $validar->errors();
            }else{
                return $validar->errors();
            }
        }
        function insertPaciente(){
            $insert = $this->modelPac->criarPaciente($this->post);
            if($insert['feedback'] == true){
                return true;
            }else{
                return false;
            }
        }

        function delPaciente(){
            $del = $this->modelPac->delPaciente($this->post);
            return $del;
        }

        function updatePaciente(){
            $update = $this->modelPac->updatePaciente($this->post);
            #var_dump($update);
            #die;
            return $update;
        }
    }