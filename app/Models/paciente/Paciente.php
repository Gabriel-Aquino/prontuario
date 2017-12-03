<?php

namespace App\Models\paciente;

    class Paciente{
        private $con;

        function __construct(){
            $this->con = new \Config\Conexao();
        }

        function getPaciente(){
            $sql = "SELECT * FROM Paciente WHERE ativo = 1";
            $consulta = $this->con->getConexao()->query($sql);
            $result = mysqli_fetch_assoc($consulta);
    
            if($result){
                return ["resultado" => true, "info" => $result];
            }else{
                return ["resultado" => false, "info" => "Nada Encontrado"];
            }
        }

        function criarPaciente($dados){
            $sql = "INSERT INTO Paciente (CPF, Nome_pac, Endereco_pac, Bairro_pac, Cidade_pac,
            Estado_pac, CEP_pac, Complemento_pac, RG_pac, DT_nasc_pac, Naturalidade_pac,
            Nacionalidade_pac, Email_pac, Tel_cel,Tel_trab, Nome_pai, Nome_mae, Tipo_sangue, ativo)
            VALUES ('$dados[cpf]', '$dados[nome]', '$dados[end]', '$dados[bairro]', '$dados[cidade]',
            '$dados[estado]', '$dados[cep]', '$dados[comp]', '$dados[rg]', '$dados[dtn]',
            '$dados[natura]', '$dados[nacio]', '$dados[email]', '$dados[cell]', '$dados[tel]',
            '$dados[nomepai]', '$dados[nomemae]', '$dados[tiposanguineo]', 1)";
    
           
    
            if($this->con->getConexao()->query($sql) == true){
            
                return ["feedback" => true, "resultado" => "Medico criado!"];
                
            }else{
                echo mysqli_error($this->con->getConexao());
                return ["feedback" => false, "resultado" => "Medico nao criado!"];
                die;
            }
        }

        function mostrarPaciente(){
            $sql = "SELECT * FROM Paciente WHERE ativo = 1 order by Nome_pac";
            $consulta = $this->con->getConexao()->query($sql);
            $dados = [];
            $i = 0;
            while($res = mysqli_fetch_assoc($consulta)){
                $dados[$i] = $res;
                $i++;
            }
            return $dados;
        }

        function mostrarPaciente2(){
            $sql = "SELECT * FROM Paciente WHERE ativo = 1";
            $consulta = $this->con->getConexao()->query($sql);

            if ($consulta){
                $dados = [];
                $i = 0;
                while($res = mysqli_fetch_assoc($consulta)){
                    $dados[$i] = $res;
                    $i++;
                }
                return ["resultado" => true, "info" => $dados];
            }else{
                return ["resultado" => false, "info" => "Nada Encontrado!"];
            }
        }

        function selectPaciente($cpf){
            $sql = "SELECT * FROM Paciente WHERE CPF = '$cpf' and ativo = 1";
            $consulta = $this->con->getConexao()->query($sql);
            $result = mysqli_fetch_assoc($consulta);
            
                    if($result){
                        return ["resultado" => true, "info" => $result];
                    }else{
                        return ["resultado" => false, "info" => "Nada Encontrado"];
                    }
            }

            function delPaciente($cpf){
                $sql = "UPDATE `Paciente` SET ativo = 0 WHERE `Paciente`.`CPF` = '$cpf'";
                $consulta = $this->con->getConexao()->query($sql);
                
                if ($consulta == true){
                    return ["resultado" => "Deletado com sucesso"];
                }else{
                    return ["resultado" => "Nada encontrado"];
                }
            }

            function updatePaciente($dados){  
                $sql = "UPDATE Paciente SET CPF = '$dados[cpf]', Nome_pac = '$dados[nome]', Endereco_pac = '$dados[end]',
                Bairro_pac = '$dados[bairro]', Cidade_pac = '$dados[cidade]', Estado_pac = '$dados[estado]', CEP_pac = '$dados[cep]',
                Complemento_pac = '$dados[comp]', RG_pac = '$dados[rg]',DT_nasc_pac = '$dados[dtn]',
                Naturalidade_pac = '$dados[natura]', Nacionalidade_pac = '$dados[nacio]', Email_pac = '$dados[email]',
                Tel_cel = '$dados[tel]', Tel_trab = '$dados[cell]', Nome_pai = '$dados[nomepai]',
                Nome_mae = '$dados[nomemae]', Tipo_sangue = '$dados[tiposanguineo]' WHERE CPF = '$dados[crmget]'";

                if($this->con->getConexao()->query($sql) == true){
                    
                    return ["feedback" => true, "resultado" => "Dados do paciente alterados com sucesso!"];
                
                }else{
                echo mysqli_error($this->con->getConexao());
                return ["feedback" => false, "resultado" => "Dados do paciente não alterados!"];
                die;
                    
            }
            }
    }
