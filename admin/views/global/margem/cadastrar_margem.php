<?php
ob_start();

include "../../layout/topo.php";
?>

<h2>Cadastrar Margem de Produto</h2>
<form method="POST" action="cadastrar_margem.php">
    <label for="nome" class="form-label">Nome da Margem:</label>
    <input type="text" required class="form-control mb-4" name="nome">

    <label for="margem" class="form-label">Percentual de Margem (%):</label>
    <input type="text" required class="form-control mb-4" name="margem">

    <button class="btn btn-dark mt-4">Cadastrar</button>
</form>

<?php

include "../../layout/rodape.php";

require_once('../../../src/ValorProdutoDAO.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $margem = $_POST['margem'];

    $valorProdutoDAO = new ValorProdutoDAO();
    $valorProdutoDAO->cadastrarMargem(['nome' => $nome, 'margem' => $margem]);

    header('Location: listar_margens.php');
    exit;
}
ob_end_flush();

?>
