<?php
    session_start();
    require_once "../../src/UsuarioDAO.php";

    $usuarioDAO = new UsuarioDAO();

    if ($usuarioDAO->validarUsuario($_POST)){
        $_SESSION['login'] = $_POST['login'];
        header("Location:index.php");
    }else{
        header("Location:login.php?msg=Usuário ou senha incorretos");
    }

?>