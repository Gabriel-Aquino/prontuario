<?php

namespace App\Routes\principal;

class Principal{
    private $klein;
    private $twig;

    public function __construct($klein, $twig){
        $this->klein = $klein;
        $this->twig = $twig;
    }

    public function start(){
        $this->klein->respond('/', function ($request, $response, $service){
            if($_SESSION){
                echo $this->twig->getTwig()->render('base.html', array("user" => $_SESSION));
            }else{
                $response->redirect('/login');
            }
        });
        $this->klein->respond('/error', function ($request, $response, $service){
            if($_SESSION){
                echo $this->twig->getTwig()->render('aviso.html');
            }else{
                $response->redirect('/login');
            }
        });

    }

}