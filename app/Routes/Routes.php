<?php

namespace App\Routes;
use \Klein\Klein;

class Routes{
    private $klein;
    private $twig;

    public function __construct(){
        $this->klein = new Klein();
        $this->twig = new Twig();
        session_start();
    }
    public function start(){

        $login = new \App\Routes\login\Login($this->klein, $this->twig);
        $login->start();

        $principal = new \App\Routes\principal\Principal($this->klein, $this->twig);
        $principal->start();
        
        $medico = new \App\Routes\medico\Medico($this->klein, $this->twig);
        $medico->start();

        $medico = new \App\Routes\paciente\Paciente($this->klein, $this->twig);
        $medico->start();

        $agendamento = new \App\Routes\agendamento\Agendamento($this->klein, $this->twig);
        $agendamento->start();

        $atendimento = new \App\Routes\atendimento\Atendimento($this->klein, $this->twig);
        $atendimento->start();


        $this->klein->dispatch();
    }
    
}