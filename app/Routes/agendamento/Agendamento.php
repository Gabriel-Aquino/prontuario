<?php

namespace App\Routes\agendamento;

    use Klein\App;

    class Agendamento{
        private $klein;
        private $twig;

        function __construct($klein, $twig){
            $this->klein = $klein;
            $this->twig = $twig;
        }

        public function start(){
            $this->klein->respond('GET', '/agendamento', function ($request, $response, $service) {
                if ($_SESSION) {
                    $set = new \App\Controllers\agendamento\Agend();
                    $med = new \App\Controllers\medico\Med();
                    $pac = new \App\Controllers\paciente\Pac();
                    echo $this->twig->getTwig()->render('agendlist.html', array(
                        "dados" => $set->MostrarAgend(),
                        "user" => $_SESSION,
                        "medico" => $med->mostrarMedico(),
                        "paciente" => $pac->mostrarPaciente(),
                        "feedback" => $_GET['feedback']
                    ));
                } else{
                    $response->redirect('/login');
            }
            });

            $this->klein->respond('GET', '/agendados/medico', function ($request, $response, $service) {
                if ($_SESSION['medico'] == true) {
                   
                    $set = new \App\Controllers\agendamento\Agend();
                    $med = new \App\Controllers\medico\Med();
                    $pac = new \App\Controllers\paciente\Pac();
                    
                    echo $this->twig->getTwig()->render('agendmed.html', array(
                        "agendamento" => $set->selAgendMed($_SESSION['crm']),
                        "medico" => $med->mostrarMedico(),
                        "user" => $_SESSION,
                        "paciente" => $pac->mostrarPaciente(),
                        "feedback" => $_GET['feedback']
                    ));
                }
            });

            $this->klein->respond('GET', '/agendar', function ($request, $response, $service){
                if($_SESSION['admin']){
                    $pac = new \App\Controllers\paciente\Pac();
                    $med = new \App\Controllers\medico\Med();
                    echo $this->twig->getTwig()->render('/agendamento.html', array(
                        "paciente" => $pac->mostrarPaciente(),
                        "user" => $_SESSION,
                        "medico" => $med->mostrarMedico()
                    ));
                }else{
                    $response->redirect('/error');
                }
            });

            $this->klein->respond('POST','/agendar', function ($request, $response, $service){
                $lg = new \App\Controllers\agendamento\Agendamento($_POST);
                if($lg->Validar()){
                    $pac = new \App\Controllers\paciente\Pac();
                    $med = new \App\Controllers\medico\Med();
                    echo $this->twig->getTwig()->render('/agendamento.html', array(
                        "feedback" => $_GET['feedback'],
                        "user" => $_SESSION,
                        "medico" => $med->mostrarMedico(),
                        "paciente" => $pac->mostrarPaciente()
                    ));
                }else{
                    $lg->insertAgend();
                    $response->redirect('/agendamento?feedback=ok');
                    }

            });

            $this->klein->respond('GET', '/editar/agendamento', function ($request, $response, $service){
                if($_SESSION['admin']){
                    $med = new \App\Controllers\medico\Med();
                    $pac = new \App\Controllers\paciente\Pac();
                    $view = new \App\Controllers\agendamento\Agend();

                    echo $this->twig->getTwig()->render('/editagend.html', array(
                        "get" => $_GET['cod'],
                        "paciente" => $pac->mostrarPaciente2(),
                        "user" => $_SESSION,
                        "medico" => $med->mostrarMedico2(),
                        "dados" => $view->SelUmAgend($_GET['cod'])['info']
                       # var_dump($view->SelUmAgend($_GET['cod'])['info']),
                       # die
                    ));

                }else{
                    $response->redirect('/error');
                }
            });

            $this->klein->respond('POST','/editar/agendamento', function ($request, $response, $service){
                $lg = new \App\Controllers\agendamento\Agendamento($_POST);
                if($lg->Validar()){
                    $med = new \App\Controllers\medico\Med();
                    $pac = new \App\Controllers\paciente\Pac();
                    echo $this->twig->getTwig()->render('/editagend.html', array(
                        "feedback" => $_GET['feedback'],
                        "user" => $_SESSION,
                        "paciente" => $pac->mostrarPaciente2(),
                        "medico" => $med->mostrarMedico2(),
                        "erros" => $lg->Validar(),
                        "dados" => $_POST
                    ));
                }else{
                    $lg->updateAgend();
                    $response->redirect('/agendamento?feedback=ok');
                }
            });

            $this->klein->respond('GET','/excluir/agendamento', function ($request, $response, $service){
                if($_SESSION['admin']){
                    $del = new \App\Controllers\agendamento\Agendamento($_GET['cod']);
                    $del->delAgend();
                    #$view = new \App\Controllers\medico\Med();
                    $response->redirect('/agendamento?feedback');
                }else{
                    $response->redirect('/error');
                }
            });



        }
    }