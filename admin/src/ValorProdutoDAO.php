<?php
require_once('ConexaoBD.php');

class ValorProdutoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    // Método para consultar a margem por ID
    public function consultarMargemPorID($id)
    {
        $sql = "SELECT margem FROM margem_produto WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrarMargem($dados) {
        $conexao = ConexaoBD::getConexao();
        $nome = $dados['nome'];
        $margem = $dados['margem'];

        $sql = "INSERT INTO margem_produto (nome, margem) VALUES ('$nome', $margem)";
        $conexao->exec($sql);
    }

    // Método para listar margens
    public function listarMargens() {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM margem_produto";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }


    public function atualizarMargem($id, $nome, $margem) {
        $conexao = ConexaoBD::getConexao();
        $sql = "UPDATE margem_produto SET nome = :nome, margem = :margem WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':margem', $margem);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function excluirMargem($id) {
        $conexao = ConexaoBD::getConexao();
        $sql = "DELETE FROM margem_produto WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
