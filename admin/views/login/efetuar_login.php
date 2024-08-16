<?php
session_start();
require_once "../../src/UsuarioDAO.php";
require_once "../../src/AcessLogDAO.php";



$usuarioDAO = new UsuarioDAO();
$accessLogDAO = new AccessLogDAO(); // Instancia a classe AccessLogDAO

// Valida o usuário
$usuario = $usuarioDAO->validarUsuario($_POST);


if ($usuario) {
    // Guarda informações do usuário na sessão
    $_SESSION['login'] = $usuario['nome'];
    $_SESSION['admin_id'] = $usuario['idadmin']; // O id é obtido do array retornado

    // Registra o log de acesso
    $accessLogDAO->registrarLog($usuario['idadmin'], 'Login efetuado');
    header("Location:/admin/index.php");
} else {
    header("Location:login.php?msg=Usuário ou senha incorretos");
}
