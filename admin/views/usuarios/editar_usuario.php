<?php
    include "../layout/topo.php";
    require_once('../../src/usuarioDAO.php');
    $usuarioDAO = new UsuarioDAO();
// Verifica se 'idadmin' está definido e não está vazio
if (isset($_GET['idadmin']) && !empty($_GET['idadmin'])) {
    $usuarioDAO->editar($_POST, $_GET['idadmin']);
    echo "<h1>Editado com sucesso!</h1>";
} else {
    echo "<h1>Erro: ID do usuário não foi encontrado!</h1>";
}
    ?>
<?php
    include "../layout/rodape.php";
    ?>