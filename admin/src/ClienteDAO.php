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


}

?>