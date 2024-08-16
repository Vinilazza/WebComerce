<?php
    require_once "src/UsuarioDAO.php";
    $usuarioDAO = new UsuarioDAO();
   
if(isset($_POST['login']))

if ($_POST['senha'] == $_POST['senha2']){
    if (!$usuarioDAO->consultarLogin($_POST['login'])){

        $usuarioDAO->cadastrar($_POST);
        header("Location:index.php?msg=Usuário cadastrado");

    }else{
    header("Location:form_cadastro_usuario.php?msg=Usuário existente");
    }
}else{
    header("Location:form_cadastro_usuario.php?msg=Senhas não conferem");
    }
?>