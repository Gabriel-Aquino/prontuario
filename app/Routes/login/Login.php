<?php

namespace App\Routes\login;

class Login{

    private $klein;
    private $twig;

    function __construct($klein, $twig){
        $this->klein = $klein;
        $this->twig = $twig;
    }

    public function start(){
        $this->klein->respond('GET','/login', function ($request, $response, $service){
            if($_SESSION){
                $response->redirect('/');
                }else{
                    echo $this->twig->getTwig()->render('/login.html');
                }
        });


        $this->klein->respond('POST','/login', function ($request, $response, $service){
            $lg = new \App\Controllers\login\Login($_POST);
            if($_POST['perfil'] == 'Admin') {
                if (count($lg->validar()) > 0) {
                    echo $this->twig->getTwig()->render('/login.html', array("aviso" => $lg->validar()#['info']
                    ));
                } else {
                    $_SESSION['resultado'] = true;
                    $_SESSION['resultadoMed'] = false;
                    $response->redirect('/');
                }
            }else if($_POST['perfil'] == 'Medico'){
                if (count($lg->validar()) > 0) {
                    echo $this->twig->getTwig()->render('/login.html', array("aviso" => $lg->validar()#['info']
                    ));
                } else {
                    $_SESSION['resultado'] = false;
                    $_SESSION['resultadoMed'] = true;
                    $response->redirect('/agendados/medico?feedback');
                }
            }
        });


        $this->klein->respond('GET','/logout', function ($request, $response, $service){
            if($_SESSION){
                session_destroy();
                $response->redirect('/login');
            }
        });
    
    }
}
