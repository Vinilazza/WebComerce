<?php
    session_start();
    session_destroy();

    header("Location:admin/views/login/login.php");

?>