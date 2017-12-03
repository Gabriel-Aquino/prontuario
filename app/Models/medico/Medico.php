<?php

namespace App\Models\medico;

class Medico{
    private $con;

    function __construct(){
        $this->con = new \Config\Conexao();
    }

    function getMedico(){
        $sql = "SELECT * FROM Medico WHERE ativo = 1";
        $consulta = $this->con->getConexao()->query($sql);
        $result = mysqli_fetch_assoc($consulta);

        if($result){
            return ["resultado" => true, "info" => $result];
        }else{
            return ["resultado" => false, "info" => "Nada Encontrado"];
        }
    }

    function criarMedico($dados){
        $sql = "INSERT INTO Medico (CRM, Nome_med, Endereco, Bairro, Cidade, Estado,
        CEP, Complemento, CPF, RG, DT_NASCIMENTO,
        Naturalidade, Nacionalidade, Email, Telefone,
        Celular, Trabalho, Especialidades, ativo)
        VALUES ('$dados[crm]', '$dados[nome]', '$dados[end]', '$dados[bairro]', '$dados[cidade]',
        '$dados[estado]', '$dados[cep]', '$dados[comp]', '$dados[cpf]', '$dados[rg]', '$dados[dtn]',
        '$dados[natura]', '$dados[nacio]', '$dados[email]', '$dados[tel]', '$dados[cell]',
        '$dados[trab]', '$dados[esp]', 1)";

       

        if($this->con->getConexao()->query($sql) == true){
        
            return ["feedback" => true, "resultado" => "Medico criado!"];
            
        }else{
            echo mysqli_error($this->con->getConexao());
            return ["feedback" => false, "resultado" => "Medico nao criado!"];
            die;
        }
    }

    /*function criarMedTest(){
        $sql = "INSERT INTO `Medico`
        (`CRM`, `Nome_med`, `Endereco`, `Bairro`, `Cidade`, `Estado`,
        `CEP`, `Complemento`, `CPF`, `RG`, `DT_NASCIMENTO`,
        Naturalidade, `Nacionalidade`, `Email`, `Telefone`,
        `Celular`, `Trabalho`, `Especialidades`)
        VALUES ('0000', 'Geovane', 'Rua tal', 'Brasil novo', 'Imperatriz',
        'Maranhao', '65900-000', 'perto da igreja', '02938475618', '0387564638281', '29/10/2017',
        'maranhense', 'brasileiro', 'geova@fjhahs.com', '9984857564', '9984756342',
        'ladrao', 'furto')";

        $consulta = $this->con->getConexao()->query($sql);

        if ($consulta == true){
            return ["resultado" => "Criado com Sucesso!"];
        }else{
            return ["resultado" => "Dados Não Inseridos"];
        }
    } */

    function delMedico($crm){
        $sql = "UPDATE Medico SET ativo = 0 WHERE Medico.CRM = '$crm'";
        #$sql = "DELETE FROM `Medico` WHERE `Medico`.`CRM` = $crm";
        $consulta = $this->con->getConexao()->query($sql);

        if ($consulta == true){
            return ["resultado" => "Deletado com sucesso"];
        }else{
            return ["resultado" => "Nada encontrado"];
        }
    }
    
     /*function deleteAllMedico(){
        $sql = "DELETE FROM `Medico'";
        $consulta = $this->con->getConexao()->query($sql);

        if ($consulta == true){
            return ["resultado" => "Deletado com sucesso"];
        }else{
            return ["resultado" => "Nada encontrado"];
        }
    }*/

    function mostrarMedico(){
        $sql = "SELECT * FROM Medico WHERE ativo = 1 order by Nome_med";
        $consulta = $this->con->getConexao()->query($sql);
        $dados = [];
        $i = 0;
        while($res = mysqli_fetch_assoc($consulta)){
            $dados[$i] = $res;
            $i++;
        }
        return $dados;
    }

    function mostrarMedico2(){
        $sql = "SELECT * FROM Medico WHERE ativo = 1";
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
            return ["resultado" => false, "info" => "Nada Encontrado"];
        }
    }

    function updateMedico($dados){  
        $sql = "UPDATE Medico SET CRM = '$dados[crm]', Nome_med = '$dados[nome]', Endereco = '$dados[end]',
        Bairro = '$dados[bairro]', Cidade = '$dados[cidade]', Estado = '$dados[estado]', CEP = '$dados[cep]',
        Complemento = '$dados[comp]',CPF = '$dados[cpf]', RG = '$dados[rg]',DT_NASCIMENTO = '$dados[dtn]',
        Naturalidade = '$dados[natura]', Nacionalidade = '$dados[nacio]', Email = '$dados[email]',
        Telefone = '$dados[tel]', Celular = '$dados[cell]', Trabalho = '$dados[trab]',
        Especialidades = '$dados[esp]' WHERE CRM = '$dados[crmget]'";

        if($this->con->getConexao()->query($sql) == true){
    
            return ["feedback" => true, "resultado" => "Dados do médico alterados com sucesso!"];
        
        }else{
        echo mysqli_error($this->con->getConexao());
        return ["feedback" => false, "resultado" => "Dados médicos não alterados!"];
        die;
            
    }
    }

    function selectMedico($crm){
        $sql = "SELECT * FROM Medico WHERE CRM = '$crm' and ativo = 1";
        $consulta = $this->con->getConexao()->query($sql);
        $result = mysqli_fetch_assoc($consulta);
        
                if($result){
                    return ["resultado" => true, "info" => $result];
                }else{
                    return ["resultado" => false, "info" => "Nada Encontrado"];
                }
        }

    function selectMedico2($crm, $nome){
        $sql = "SELECT * FROM Medico WHERE Nome_med = '$nome' and CRM = '$crm' and ativo = 1";
        $consulta = $this->con->getConexao()->query($sql);
        $result = mysqli_fetch_assoc($consulta);

        if($result){
            return ["resultado" => true, "info" => $result];
        }else{
            return ["resultado" => false, "info" => "Nada Encontrado"];
        }
    }
}