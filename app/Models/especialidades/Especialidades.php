<?php

namespace App\Models\especialidades;

    class Especialidades{
        private $con;

        function __construct(){
            $this->con = new \Config\Conexao();
        }

        function getEspecialidades(){
            $sql = "SELECT nome FROM especialidades ORDER BY nome";
            $consulta = $this->con->getConexao()->query($sql);
            if($consulta){
            $dados = [];
            $i = 0;
            while($res = mysqli_fetch_assoc($consulta)){
                $dados[$i] = $res;
                $i++;
            }
            return ["resultado" => true, "info" => $dados];
        }else{
            return ["resultado" => false, "info" => "Nada encontrado"];
        }
    }
}