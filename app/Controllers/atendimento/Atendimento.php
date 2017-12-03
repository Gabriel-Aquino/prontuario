<?php

namespace App\Controllers\atendimento;

    class Atendimento{
        private $con;
        private $post;
        private $modelAtend;

        function __construct($post){
            $this->con = new \Config\Conexao();
            $this->post = $post;
            $this->modelAtend = new \App\Models\atendimento\Atendimento();
        }

        function insertAtend(){
            
            $insert = $this->modelAtend->insertAtend($this->post);
    
            if($insert['feedback'] == true){
                return true;
            }else{
                return false;
            }
        }

        function insertSinais(){
            $insert = $this->modelAtend->insertSinais($this->post);
        }

        function insertHipotese(){
            $insert = $this->modelAtend->insertHipotese($this->post);
        }

        function insertEvolucao(){
            $insert = $this->modelAtend->insertEvolucao($this->post);
        }
        
        function insertAtestado(){
            $insert = $this->modelAtend->insertAtestado($this->post);
        }

        function insertPrescricao(){
            $insert = $this->modelAtend->insertPrescricao($this->post);
        }
        
    }