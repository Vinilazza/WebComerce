<?php 
require_once "ConexaoBD.php";

class CategoriaDAO{

    public function consultarCategorias(){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM categorias";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}