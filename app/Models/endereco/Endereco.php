<?php

namespace App\Models\endereco;

    class Endereco{
        private $con;

        function __construct(){
            $this->con = new \Config\Conexao();
        }

        function getEstado(){
            $sql = "SELECT Nome FROM Estado ORDER BY Nome"; 
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

        function getCidade(){
            $sql = "SELECT Nome FROM Municipio ORDER BY Nome";
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
    };