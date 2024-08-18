<?php
require_once "ConexaoBD.php";

class UsuarioDAO {

    function cadastrar($dados) {
        $conexao = ConexaoBD::getConexao();
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':senha' => $senhaHash
        ]);
    }

    function editar($dados, $id) {
        $conexao = ConexaoBD::getConexao();
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET nome = :nome, email = :email, senha = :senha WHERE idadmin = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':senha' => $senhaHash,
            ':id' => $id
        ]);
    }

    function consultarPorChave($chave) {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM admin WHERE nome LIKE :chave";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':chave' => "%$chave%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function consultarLogin($nome) {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM admin WHERE nome = :nome";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':nome' => $nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function consultarUsuarioPorID($id){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM admin WHERE idadmin = $id";
        
        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public function consultarUsuarios() {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM admin";
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function validarUsuario($dados) {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT idadmin, nome, email, senha FROM admin WHERE nome = :nome";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':nome' => $dados['nome']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($dados['senha'], $usuario['senha'])) {
            return $usuario; // Retorna o array com id, nome, email e senha
        }

        return false; // Retorna false se o login falhar
    }

    public function deletar($id) {
        $conexao = ConexaoBD::getConexao();
        $sql = "DELETE FROM admin WHERE idadmin = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
