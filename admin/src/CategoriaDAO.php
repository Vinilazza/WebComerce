<?php

require_once 'ConexaoBD.php';

class CategoriaDAO {
    
    private $conexao;

    public function __construct() {
        $this->conexao = ConexaoBD::getConexao();
    }

    // Método para consultar todas as categorias
    public function consultarCategorias() {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para consultar uma categoria por ID
    public function consultarCategoriaPorID($idcategoria) {
        $sql = "SELECT * FROM categorias WHERE idcategoria = :idcategoria";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idcategoria', $idcategoria);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para adicionar uma nova categoria
    public function adicionarCategoria($categoria) {
        $sql = "INSERT INTO categorias (categoria) VALUES (:categoria)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':categoria', $categoria);
        $stmt->execute();
    }

    // Método para editar uma categoria existente
    public function editarCategoria($idcategoria, $categoria) {
        $sql = "UPDATE categorias SET categoria = :categoria WHERE idcategoria = :idcategoria";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':categoria', $categoria);
        $stmt->bindValue(':idcategoria', $idcategoria);
        $stmt->execute();
    }

    // Método para deletar uma categoria
    public function deletarCategoria($idcategoria) {
        $sql = "DELETE FROM categorias WHERE idcategoria = :idcategoria";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idcategoria', $idcategoria);
        $stmt->execute();
    }
}

?>
