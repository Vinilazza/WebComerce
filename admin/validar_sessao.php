<?php
    session_start();

    if(!isset($_SESSION['login']))
    header("Location:login.php?msg=Usuário não permitido!");

?>