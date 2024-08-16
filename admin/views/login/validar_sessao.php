<?php
    session_start();

    if(!isset($_SESSION['login']))
    header("Location:/admin/views/login/login.php?msg=Usuário não permitido!");

?>