<?php

namespace App\Routes\paciente;

    class Paciente{
        private $klein;
        private $twig;

        function __construct($klein, $twig){
            $this->klein = $klein;
            $this->twig = $twig;
        }

        public function start(){
            $this->klein->respond('GET', '/cadastro_paciente', function ($request, $response, $service){
                if($_SESSION['admin']){
                    $end = new \App\Controllers\endereco\Endereco();
                    echo $this->twig->getTwig()->render('/cadpaciente.html', array(
                        "feedback" => $_GET['feedback'],
                        "user" => $_SESSION,
                        "estado" => $end->selEstado(),
                        "cidade" => $end->selCidade()
                    ));
                    }else{
                        $response->redirect('/error');
                    }
            });
            
            $this->klein->respond('POST','/cadastro_paciente', function ($request, $response, $service){
                $lg = new \App\Controllers\paciente\Paciente($_POST);
                 if($lg->Validar()){
                     $end = new \App\Controllers\endereco\Endereco();
                     echo $this->twig->getTwig()->render('/cadpaciente.html', array(
                         "feedback" => $_GET['feedback'],
                         "user" => $_SESSION,
                         "estado" => $end->selEstado(),
                         "cidade" => $end->selCidade(),
                         "erros" => $lg->Validar()
                     ));
                 }else{
                    
                     $lg->insertPaciente();
                     $response->redirect('/cadastro_paciente?feedback=ok');
                 }
             });

             $this->klein->respond('/pacientes', function ($request, $response, $service){
                if($_SESSION){
                    $view = new \App\Controllers\paciente\Pac();
                    echo $this->twig->getTwig()->render('/mostrarpac.html', array(
                    "dados" => $view->mostrarPaciente(),
                        "user" => $_SESSION,
                    "feedback" => $_GET['feedback']
                    ));
                    }else{
                        $response->redirect('/login');
                    }
            });

            $this->klein->respond('GET','/excluir/pacientes', function ($request, $response, $service){
                if($_SESSION['admin']){
                    $del = new \App\Controllers\paciente\Paciente($_GET['cpf']);
                    $del->delPaciente();
                    #$view = new \App\Controllers\medico\Med();
                    $response->redirect('/pacientes?feedback');
                    }else{
                        $response->redirect('/error');
                    }
            });

            $this->klein->respond('GET', '/editar/paciente', function ($request, $response, $service){
                if($_SESSION['admin']){
                   
                    $view = new \App\Controllers\paciente\Pac();
                    $end = new \App\Controllers\endereco\Endereco();
                    echo $this->twig->getTwig()->render('/editpac.html', array(
                        "get" => $_GET['cpf'], 
                        "dados" => $view->selUmPac($_GET['cpf'])['info'],
                        "user" => $_SESSION,
                        "estado" => $end->selEstado(),
                        "cidade" => $end->selCidade()
                    ));
                        
                    }else{
                        $response->redirect('/error');
                    }
            });
            $this->klein->respond('POST','/editar/paciente', function ($request, $response, $service){
                $lg = new \App\Controllers\paciente\Paciente($_POST);
                if($lg->Validar()){
                    $end = new \App\Controllers\endereco\Endereco();
                    echo $this->twig->getTwig()->render('/cadpaciente.html', array(
                        "feedback" => $_GET['feedback'],
                        "estado" => $end->selEstado(),
                        "user" => $_SESSION,
                        "cidade" => $end->selCidade(),
                        "erros" => $lg->Validar(),
                        "dados" => $_POST
                    ));
                }else{
                $lg->updatePaciente();
                $response->redirect('/pacientes?feedback=ok');
                }
        });
        }
    }