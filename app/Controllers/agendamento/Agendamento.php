<?php

namespace App\Controllers\agendamento;

    use Composer\Config;

    class Agendamento{
        private $con;
        private $post;
        private $modelAgend;

        function __construct($post){
            $this->con = new \Config\Conexao();
            $this->modelAgend = new \App\Models\agendamento\Agendamento();
            $this->post = $post;
        }

        function Validar(){
            $validar = new \Valitron\Validator($this->post);

            $validar->rule('required', array('paciente', 'medico',
                'data', 'hora'))->message('{field} é obrigatório');
            if($validar->validate()){
                return $validar->errors();
            }else{
                return $validar->errors();
            }
        }

        function insertAgend(){
            $insert = $this->modelAgend->insertAgend($this->post);

            if($insert['feedback'] == true){
                return true;
            }else{
                return false;
            }
        }

        function delAgend(){
            $del = $this->modelAgend->delAgend($this->post);
            return $del;
        }

        function updateAgend(){
            $update = $this->modelAgend->updateAgend($this->post);
            return $update;
        }
    }