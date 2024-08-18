<?php
    include "../layout/topo.php";
    require_once('../../src/UsuarioDAO.php');

    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->consultarUsuarioPorID($_GET['idadmin']);
?>

    <h2>Cadastro de Produto</h2>
    <form method="POST" action="editar_usuario.php?idadmin=<?=$usuario['idadmin']?>" enctype="multipart/form-data">

        <label for="nome" class="form-label">Nome:</label>
        <input type="text" required class="form-control mb-4" name="nome" value="<?=$usuario['nome']?>">

        <label for="email" class="form-label">Email:</label>
        <input type="text" required class="form-control mb-4" name="email" value="<?=$usuario['email']?>" >

        <label for="senha" class="form-label">Senha Nova:</label>
        <input type="text" required class="form-control mb-4" name="senha">

        <button class="btn btn-dark mt-4">Editar</button>


    </form>

<?php
include "../layout/rodape.php";
?>