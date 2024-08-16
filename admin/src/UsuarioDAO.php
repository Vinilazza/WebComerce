<?php
require_once "ConexaoBD.php";

class UsuarioDAO{

    function cadastrar($dados){
        $conexao = ConexaoBD::getConexao();
        $senha = md5($dados['senha']);
        $sql = "insert into usuarios (login, senha) values ('{$dados['login']}','{$senha}')";
        $conexao->exec($sql);
    }

    function editar($dados){
        $conexao = ConexaoBD::getConexao();
        $senha = md5($dados['senha']);
        $sql = "insert into usuarios (login, senha) values ('{$dados['login']}','{$senha}')";
        $conexao->exec($sql);
    }

    function consultarPorChave($chave){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM usuarios where login like'%$chave%'";

        $resultado = $conexao->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }

    function consultarLogin($login){
        $conexao = ConexaoBD::getConexao();
        $sql = "select * from usuarios where login='$login'";
        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);
        }

        public function consultarUsuarios(){
            $conexao = ConexaoBD::getConexao();
            $sql = 'SELECT * FROM usuarios';
            $resultado = $conexao->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function consultarProdutoPorID($id){
            $conexao = ConexaoBD::getConexao();
    
            $sql = "SELECT * FROM usuarios WHERE idproduto = $id";
            
            $resultado = $conexao->query($sql);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        }

    function validarUsuario($dados){
        $conexao = ConexaoBD::getConexao();
        $senha = md5($dados["senha"]);
        $sql = "select * from usuarios where login='{$dados['login']}' and senha='{$senha}'";
        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);
        }

        public function deletar($id){
            $conexao = ConexaoBD::getConexao();
            $sql = "DELETE FROM usuarios WHERE idusuarios=$id";
            
            $conexao->exec($sql);
        }
    }

    
