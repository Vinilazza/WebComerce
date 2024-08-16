<?php
require_once "ConexaoBD.php";

class ClienteDAO{

    public function consultarcliente($email){
        $conexao = ConexaoBD::getConexao();

        $sql = "select idcliente,nome,email,endereco from clientes where email='$email'";

        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);

    }
}

?>