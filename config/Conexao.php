<?php

namespace Config;

class Conexao{
    protected $con;
    private $host = "localhost";
    private $user = "root";
    private $senha = "";
    private $bd = "mydb1";

    public function __construct(){
        $this->con = mysqli_connect($this->host, $this->user, $this->senha, $this->bd);        
        $this->con->set_charset("utf8");
    }

    function testeConexao(){
        if($this->con->connect_error) {
          die("Connection failed: " . $con->connect_error);
        }else{
          echo "Conectado";
        }
  
      }
      function getConexao(){
        return $this->con;
      }
}