<?php
require_once "ConexaoBD.php";

class ClienteDAO{

    public function consultarcliente($email){
        $conexao = ConexaoBD::getConexao();

        $sql = "select idcliente,nome,email,endereco from clientes where email='$email'";

        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);

    }

    public function consultarClientes() {
        $conexao = ConexaoBD::getConexao();

        $sql = "select idcliente,nome,email,endereco from clientes";

        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);  
    }

    function consultarPorChave($chave){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM clientes where nome like'%$chave%'";

        $resultado = $conexao->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }

    function registrarVisita(){
        $conexao = ConexaoBD::getConexao();

     $ip = $_SERVER['REMOTE_ADDR']; 
     $query = "INSERT INTO visitas (ip) VALUES (:ip)";
     $stmt = $conexao->prepare($query);
     $stmt->bindParam(':ip', $ip);
     $stmt->execute();
    }

    function contarVisitas() {
        $conexao = ConexaoBD::getConexao();

        $query = "SELECT COUNT(*) AS total FROM visitas";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

}

?>