<?php

namespace App\Models\atendimento;

    class Atendimento{
        private $con;

        function __construct(){
            $this->con = new \Config\Conexao();
        }

        public function insertAtend($dados){

            $sql = "INSERT INTO Atendimento (queixa_p, Hist, prb_renal, prb_articular, prb_card,
            prb_resp, prb_gast, alergias, hepatite, gravidez, diabetes, prb_cicatriz, utl_medicamento,
            Agendamento_Cod, ativo) 
            VALUES ('$dados[queixa]', '$dados[hist]', '$dados[renal]', '$dados[art]',
            '$dados[card]', '$dados[resp]', '$dados[gast]', '$dados[alergia]', '$dados[hep]',
            '$dados[grav]', '$dados[dia]', '$dados[cic]', '$dados[medc]', '$dados[agendamento]',
            1)";

            if($this->con->getConexao()->query($sql) == true){
                $agendamento = new \App\Models\agendamento\Agendamento();
                $agendamento->delAgend($dados['agendamento']);
                return ["feedback" => true, "resultado" => "Atendimento feito"];

            }else{
                echo mysqli_error($this->con->getConexao());
                die;
                return ["feedback" => false, "resultado" => "Atendimento nao criado!"];
            }
        }

        function insertSinais($dados){
           
            $sql = "INSERT INTO sinais_vitais (hora, data_sinais, altura, peso, imc,
            temperatura, dor, ativo, codigo_agendamento) 
            VALUES ('$dados[data]', '$dados[hora]', '$dados[alt]', '$dados[peso]',
            '$dados[imc]', '$dados[temp]', '$dados[dor]', 1, '$dados[codigo]')";

            if($this->con->getConexao()->query($sql) == true){
             
                return ["feedback" => true, "resultado" => "Atendimento feito"];

            }else{
                echo mysqli_error($this->con->getConexao());
                die;
                return ["feedback" => false, "resultado" => "Atendimento nao criado!"];
            }

        }


        function insertHipotese($dados){
            
             $sql = "INSERT INTO hipoteses (hipotese, observacoes, ativo, codigo_agendamento) 
             VALUES ('$dados[hipotese]', '$dados[observacao]', 1, '$dados[codigo]')";
 
             if($this->con->getConexao()->query($sql) == true){
              
                 return ["feedback" => true, "resultado" => "Atendimento feito"];
 
             }else{
                 echo mysqli_error($this->con->getConexao());
                 die;
                 return ["feedback" => false, "resultado" => "Atendimento nao criado!"];
             }
 
         }

         function insertEvolucao($dados){
          
             $sql = "INSERT INTO evolucao(evolucao, ativo, codigo_agendamento) 
             VALUES ('$dados[evolucao]', 1, '$dados[codigo]')";
 
             if($this->con->getConexao()->query($sql) == true){
              
                 return ["feedback" => true, "resultado" => "Atendimento feito"];
 
             }else{
                 echo mysqli_error($this->con->getConexao());
                 die;
                 return ["feedback" => false, "resultado" => "Atendimento nao criado!"];
             }
 
         }

        function insertAtestado($dados){
            
            $sql = "INSERT INTO atestado(texto, ativo, codigo_agendamento) 
            VALUES ('$dados[texto]', 1, '$dados[codigo]')";

            if($this->con->getConexao()->query($sql) == true){
            
                return ["feedback" => true, "resultado" => "Atendimento feito"];

            }else{
                echo mysqli_error($this->con->getConexao());
                die;
                return ["feedback" => false, "resultado" => "Atendimento nao criado!"];
            }

        }

        function insertPrescricao($dados){
        
            $sql = "INSERT INTO prescricao(prescricao, ativo, codigo_agendamento) 
            VALUES ('$dados[prescricao]', 1, '$dados[codigo]')";

            if($this->con->getConexao()->query($sql) == true){
            
                return ["feedback" => true, "resultado" => "Atendimento feito"];

            }else{
                echo mysqli_error($this->con->getConexao());
                die;
                return ["feedback" => false, "resultado" => "Atendimento nao criado!"];
            }

        }

        function selUmAtend($cod){
            $sql = "SELECT * FROM Atendimento WHERE Agendamento_Cod = '$cod'";
            $consulta = $this->con->getConexao()->query($sql);
            $result = mysqli_fetch_assoc($consulta);

            if($result){
                return ["resultado" => true, "info" => $result];
            }else{
                return ["resultado" => false, "info" => "Nada Encontrado"];
            }

        }


    }