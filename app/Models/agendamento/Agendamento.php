<?php

namespace App\Models\agendamento;

    class Agendamento{
        private $con;

        function __construct(){
            $this->con = new \Config\Conexao();
        }
        function getAgendamento(){
            $sql = "SELECT * FROM `Agendamento` WHERE ativo = 1";
            $consulta = $this->con->getConexao()->query($sql);
            $result = mysqli_fetch_assoc($consulta);

            if($result){
                return ["resultado" => true, "info" => $result];
            }else{
                return ["resultado" => false, "info" => "Nada Encontrado"];
            }
        }

        function updateAgend($dados){
            $sql = "UPDATE `Agendamento` SET Cod = '$dados[cod]', `Data_agend` = '$dados[data]',
            `Hora_agend` = '$dados[hora]', `Paciente_agend` = '$dados[paciente]',
            `Medico_agend` = '$dados[medico]' WHERE `Agendamento`.`Cod` = '$dados[crmget]'";

            if($this->con->getConexao()->query($sql) == true){

                return ["feedback" => true, "resultado" => "Dados do médico alterados com sucesso!"];

            }else{
                echo mysqli_error($this->con->getConexao());
                return ["feedback" => false, "resultado" => "Dados médicos não alterados!"];
                die;

            }
        }

        /*function CriarAgendTest(){
            $sql = "INSERT INTO Agendamento (`Cod`, `Data_agend`,
            `Hora_agend`, `Paciente_agend`, `Medico_agend`) VALUES ('','23/11/2017', '15:42',
            'Gabriel', 'Geovane')";

            if ($this->con->getConexao()->query($sql) == true){
                return ["feedback" => true, "resultado" => "Agendado!"];

            }else{
                echo mysqli_error($this->con->getConexao());
                return ["feedback" => false, "resultado" => "Não agendado!"];
                die;
            }
            }*/
        function insertAgend($dados){
            $sql = "INSERT INTO Agendamento (`Data_agend`, `Hora_agend`,
            `Paciente_agend`, `Medico_agend`, ativo) VALUES ('$dados[data]', '$dados[hora]',
            '$dados[paciente]', '$dados[medico]', 1)";


            #var_dump($dados);
            #die;
            if($this->con->getConexao()->query($sql) == true){

                return ["feedback" => true, "resultado" => "Agendamento criado!"];

            }else{
                echo mysqli_error($this->con->getConexao());
                return ["feedback" => false, "resultado" => "Agendamento não criado!"];
                die;
            }
        }

        function mostrarAgend(){
            $sql = "SELECT * FROM Agendamento WHERE ativo = 1 order by Cod";
            $consulta = $this->con->getConexao()->query($sql);
            $dados = [];
            $i = 0;
            while($res = mysqli_fetch_assoc($consulta)){
                $dados[$i] = $res;
                $i++;
            }
            return $dados;
        }

        function selectAgend($cod){
            $sql = "SELECT * FROM Agendamento WHERE Cod = '$cod' and ativo = 1";
            $consulta = $this->con->getConexao()->query($sql);
            $result = mysqli_fetch_assoc($consulta);

            if($result){
                return ["resultado" => true, "info" => $result];
            }else{
                return ["resultado" => false, "info" => "Nada Encontrado"];
            }
        }

        function delAgend($cod){
            $sql = "UPDATE Agendamento SET ativo = 0 WHERE Agendamento.Cod = '$cod'";
            #$sql = "DELETE FROM `Medico` WHERE `Medico`.`CRM` = $crm";
            $consulta = $this->con->getConexao()->query($sql);

            if ($consulta == true){
                return ["resultado" => "Deletado com sucesso"];
            }else{
                return ["resultado" => "Nada encontrado"];
            }
        }

        function selAgendMed($crm){

            $sql = "SELECT * FROM Agendamento WHERE Medico_agend = $crm and ativo = 1";
            $consulta = $this->con->getConexao()->query($sql);
            $dados = [];
            $i = 0;
            while($res = mysqli_fetch_assoc($consulta)){
                $dados[$i] = $res;
                $i++;
            }
            return $dados;
        }

        function selAgendPac($cpf){
            $sql = "SELECT * FROM Agendamento WHERE Paciente_agend = '$cpf'";
            $consulta = $this->con->getConexao()->query($sql);
            $dados = [];
            $i = 0;
            while($res = mysqli_fetch_assoc($consulta)){
                $dados[$i] = $res;
                $i++;
            }
            return $dados;
        }

        function selHip($cod){
            $sql = "SELECT * FROM hipoteses WHERE codigo_agendamento = '$cod'";
            $consulta = $this->con->getConexao()->query($sql);
            $dados = [];
            $i = 0;
            while($res = mysqli_fetch_assoc($consulta)){
                $dados[$i] = $res;
                $i++;
            }
            return $dados;
        }



        function selAll($cpf){
            $agendamentos = $this->selAgendPac($cpf);

            $dados = [];
            $i = 0;

            foreach ($agendamentos as $agendamento){
                $modelAntedimento = new \App\Models\atendimento\Atendimento();
                $atendimento = $modelAntedimento->selUmAtend($agendamento['Cod']);
                $dados[$i] = $atendimento['info'];
                $i++;
            }

            return $dados;

        }
    }
