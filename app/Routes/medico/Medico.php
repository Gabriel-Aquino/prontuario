<?php

namespace App\Routes\medico;

class Medico{
    
    private $klein;
    private $twig;

    function __construct($klein, $twig){
        $this->klein = $klein;
        $this->twig = $twig;
    }

    public function start(){
        $this->klein->respond('GET', '/cadastro_medico', function ($request, $response, $service){
            if($_SESSION['admin']){
                $esp = new \App\Controllers\especialidades\Especialidades();
                $end = new \App\Controllers\endereco\Endereco();
                echo $this->twig->getTwig()->render('/cadmed.html', array(
                    "feedback" => $_GET['feedback'],
                    "user" => $_SESSION,
                    "especialidades" => $esp->selAllEsp(),
                    "estado" => $end->selEstado(),
                    "cidade" => $end->selCidade()
                ));
                }else{
                    $response->redirect('/error');
                }
        });

        $this->klein->respond('POST','/cadastro_medico', function ($request, $response, $service){
           $lg = new \App\Controllers\medico\Medico($_POST);
            if($lg->Validar()){
                $esp = new \App\Controllers\especialidades\Especialidades();
                $end = new \App\Controllers\endereco\Endereco();
                echo $this->twig->getTwig()->render('/cadmed.html', array(
                    "feedback" => $_GET['feedback'],
                    "user" => $_SESSION,
                    "especialidades" => $esp->selAllEsp(),
                    "estado" => $end->selEstado(),
                    "cidade" => $end->selCidade(),
                    "erros" => $lg->Validar()
                ));
            }else{
               
                $lg->insertMedico();
                $response->redirect('/cadastro_medico?feedback=ok');
            }
          
        });

        $this->klein->respond('/medicos', function ($request, $response, $service){
            if($_SESSION){
                $view = new \App\Controllers\medico\Med();
                echo $this->twig->getTwig()->render('/mostrarmed.html', array(
                "dados" => $view->mostrarMedico(),
                    "user" => $_SESSION,
                "feedback" => $_GET['feedback']
                ));
                }else{
                    $response->redirect('/login');
                }
        });
        $this->klein->respond('GET','/excluir/medicos', function ($request, $response, $service){
            if($_SESSION['admin']){
                $del = new \App\Controllers\medico\Medico($_GET['crm']);
                $del->delMedico();
                #$view = new \App\Controllers\medico\Med();
                $response->redirect('/medicos?feedback');
                }else{
                    $response->redirect('/error');
                }
        });

        $this->klein->respond('GET', '/editar/medico', function ($request, $response, $service){
            if($_SESSION['admin']){
                $view = new \App\Controllers\medico\Med();
                $esp = new \App\Controllers\especialidades\Especialidades();
                $end = new \App\Controllers\endereco\Endereco();
                echo $this->twig->getTwig()->render('/editmed.html', array(
                    "get" => $_GET['crm'], 
                    "dados" => $view->selUmMed($_GET['crm'])['info'],
                    "user" => $_SESSION,
                    "especialidades" => $esp->selAllEsp(),
                    "estado" => $end->selEstado(),
                    "cidade" => $end->selCidade()
                ));
                    
                }else{
                    $response->redirect('/error');
                }
        });
        
        $this->klein->respond('POST','/editar/medico', function ($request, $response, $service){
            $lg = new \App\Controllers\medico\Medico($_POST);
            if($lg->Validar()){
                $esp = new \App\Controllers\especialidades\Especialidades();
                $end = new \App\Controllers\endereco\Endereco();
                echo $this->twig->getTwig()->render('/cadmed.html', array(
                    "feedback" => $_GET['feedback'],
                    "user" => $_SESSION,
                    "especialidades" => $esp->selAllEsp(),
                    "estado" => $end->selEstado(),
                    "cidade" => $end->selCidade(),
                    "erros" => $lg->Validar(),
                    "dados" => $_POST
                ));
            }else{
            $lg->updateMedico();
            $response->redirect('/medicos?feedback=ok');
            }
    });
    }
}

