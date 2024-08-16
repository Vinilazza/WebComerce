<?php
    include "../layout/topo.php";
    require_once('../../src/usuarioDAO.php');
    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->editar($_POST, $_GET['idusuarios']);
    ?>

<h1>Editado com sucesso!</h1>
<?php
    include "../layout/rodape.php";
    ?>