<?php

namespace App\Controllers\login;

class Login{
    private $request;
    private $user;
    private $senha;

    function __construct($request){
        $this->request = $request;
        $this->user = $request['login'];
        $this->senha = $request['senha'];
    }
    
    public function validar(){

        if($this->request['perfil'] == "Admin"){
            $bd = new \App\Models\login\Login();
            $dado = $bd->getAdmin($this->user);
            $result = $this->verificar($dado, $this->user, $this->senha);
            $this->session($result, $dado);

            return $result;
        }else{
            $bd = new \App\Models\medico\Medico();
            $dado = $bd->selectMedico2($this->senha, $this->user);
            $result = $this->verificarMed($dado, $this->user, $this->senha);
            $this->sessionMed($result, $dado);
            return $result;
        }
    }

    function verificarMed($dado, $user, $senha){
        $status = [];
        $result = $dado['info'];
        if($dado['resultado'] == true){

            if($result['CRM'] != $senha){
                $status[] = "Senha Incorreta";
            }
            return $status;

        }
        else #if ($result['Nome_med'] != $user)
            {

            $status[] = "Usuário não cadastrado ou senha Incorreta";
            return $status;
        }
    }

    private function session($result, $dado){
        if(count($result) == 0){
            $sessao = $dado['info'];
            $_SESSION['admin'] = true;
            $_SESSION['login'] = $sessao['user'];
            $_SESSION['senha'] = $sessao['senha'];
        }else{
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
        }
    }

    private function sessionMed($result, $dado){
        if(count($result) == 0){
            $sessao = $dado['info'];
            $_SESSION['medico'] = true;
            $_SESSION['crm'] = $sessao['CRM'];
            $_SESSION['login'] = $sessao['Nome_med'];
            $_SESSION['senha'] = $sessao['CRM'];
        }else{
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
        }
    }

    function verificar($dado, $user, $senha){
        $status = [];
        if($dado['resultado'] == true){
            $result = $dado['info'];
            if($result['senha'] != $senha){
            $status[] = "Senha Incorreta";
            }
            return $status;

        }else{
            $status[] = "Usuário não cadastrado ou Incorreto";
            return $status;
        }
        }
    }
    


