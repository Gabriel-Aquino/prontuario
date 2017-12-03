<?php

namespace App\Routes\atendimento;

    class Atendimento{

        private $klein;
        private $twig;

        function __construct($klein, $twig){
            $this->klein = $klein;
            $this->twig = $twig;
        }

        public function start(){

            $this->klein->respond('GET', '/timeline', function ($request, $response, $service){

                #$modelAgendamento = new \App\Models\agendamento\Agendamento();
                #$dados = $modelAgendamento->selAll($_GET['paciente']);
                #var_dump($dados);
                #die;
                if($_SESSION['medico']){
                    $_SESSION['paciente'] = $_GET['paciente'];

                    $agendPac = new \App\Controllers\agendamento\Agend();
                    $info = $agendPac->selAll($_SESSION['paciente']);


                    echo $this->twig->getTwig()->render('/timeline.html', array(
                        "user" => $_SESSION,
                        "get" => $_GET['paciente'],
                        "dados" => $info

                    ));
                }else{
                    $response->redirect('/login');
                }
            });

            $this->klein->respond('GET', '/atender', function ($request, $response, $service){
                if($_SESSION['medico']){
                    $_SESSION['codigo'] = $_GET['cod'];
                    echo $this->twig->getTwig()->render('/atendimento.html', array(
                        "user" => $_SESSION,
                        "get" => $_GET['cod'],
                        "feedback" => $_GET['feedback']
                    ));
                }else{
                    $response->redirect('/login');
                }
            });

            $this->klein->respond('POST', '/atender', function ($request, $response, $service){

                $lg = new \App\Controllers\atendimento\Atendimento($_POST);

                $lg->insertAtend();
                $response->redirect('/agendados/medico?feedback');
            });

            $this->klein->respond('GET', '/sinais', function ($request, $response, $service){
                if($_SESSION['medico']){
                    echo $this->twig->getTwig()->render('/sinais.html', array(
                        "user" => $_SESSION,
                        "feedback" => $_GET['feedback']
                    ));
                }else{
                    $response->redirect('/login');
                }
            });

            $this->klein->respond('GET', '/fecha', function ($request, $response, $service){
                    echo $this->twig->getTwig()->render('/fecha.html', array(
                        "user" => $_SESSION,
                        "feedback" => $_GET['feedback']
                    ));
        
            });

            $this->klein->respond('POST', '/sinais', function ($request, $response, $service){
                $lg = new \App\Controllers\atendimento\Atendimento($_POST);
                $lg->insertSinais();
                $response->redirect('/fecha');
            });

            $this->klein->respond('GET', '/hipotese', function ($request, $response, $service){
             
                if($_SESSION['medico']){
                    echo $this->twig->getTwig()->render('/hipotese.html', array(
                        "user" => $_SESSION,
                        "feedback" => $_GET['feedback']
                    ));
                }else{
                    $response->redirect('/login');
                }
            });

            $this->klein->respond('POST', '/hipotese', function ($request, $response, $service){
                $lg = new \App\Controllers\atendimento\Atendimento($_POST);
                $lg->insertHipotese();
                $response->redirect('/fecha');
            });

            $this->klein->respond('GET', '/prescricao', function ($request, $response, $service){
                
                   if($_SESSION['medico']){
                       echo $this->twig->getTwig()->render('/prescricao.html', array(
                           "user" => $_SESSION,
                           "feedback" => $_GET['feedback']
                       ));
                   }else{
                       $response->redirect('/login');
                   }
               });
   
            $this->klein->respond('POST', '/prescricao', function ($request, $response, $service){
                $lg = new \App\Controllers\atendimento\Atendimento($_POST);
                $lg->insertPrescricao();
                $response->redirect('/fecha');
            });



            $this->klein->respond('GET', '/evolucao', function ($request, $response, $service){
                if($_SESSION['medico']){
                    echo $this->twig->getTwig()->render('/evolucao.html', array(
                        "user" => $_SESSION,
                        "feedback" => $_GET['feedback']
                    ));
                }else{
                    $response->redirect('/login');
                }
            });

            $this->klein->respond('POST', '/evolucao', function ($request, $response, $service){
                $lg = new \App\Controllers\atendimento\Atendimento($_POST);
                $lg->insertEvolucao();
                $response->redirect('/fecha');
            });

            $this->klein->respond('GET', '/atestado', function ($request, $response, $service){
                if($_SESSION['medico']){
                    echo $this->twig->getTwig()->render('/atestado.html', array(
                        "user" => $_SESSION,
                        "feedback" => $_GET['feedback']
                    ));
                }else{
                    $response->redirect('/login');
                }
            });

            $this->klein->respond('POST', '/atestado', function ($request, $response, $service){
                $lg = new \App\Controllers\atendimento\Atendimento($_POST);
                $lg->insertAtestado();
                $response->redirect('/fecha');
            });
        }
    }