<?php
require_once "ConexaoBD.php";

class UsuarioDAO{

    function cadastrar($dados){
        $conexao = ConexaoBD::getConexao();
        $senha = md5($dados['senha']);
        $sql = "insert into usuarios (login, senha) values ('{$dados['login']}','{$senha}')";
        $conexao->exec($sql);
    }

    function consultarLogin($login){
        $conexao = ConexaoBD::getConexao();
        $sql = "select * from usuarios where login='$login'";
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
    }