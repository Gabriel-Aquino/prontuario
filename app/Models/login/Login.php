<?php

namespace App\Models\login;

class Login{
    private $con;

    function __construct(){
        $this->con = new \Config\Conexao();
    }

    function getAdmin($user){
        $sql = "SELECT * FROM root WHERE user = '$user'";
        $dados = $this->con->getConexao()->query($sql);
        $result = mysqli_fetch_assoc($dados);

        if($result){    
            return ["resultado" => true, "info" => $result];
        }else{
            return ["resultado" => false, "info" => "Nada Encontrado"];
        }

    }
}