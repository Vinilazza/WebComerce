<?php 

class JoiaDAO{

    public function consultarJoias(){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM joias";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}