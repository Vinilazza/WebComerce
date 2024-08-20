<?php
ob_start();
    include "../layout/topo.php";
    require_once('../../src/CategoriaDAO.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoriaDAO = new CategoriaDAO();
    $nome = $_POST['nome'];

    $categoriaDAO->adicionarCategoria($nome);

    // Redireciona para a lista de categorias após o cadastro
    header("Location: listar_categorias.php");
    exit();
}
ob_end_flush();
?>

<main class="container">
    <h2 class="my-4">Cadastrar Nova Categoria</h2>
    <form action="cadastrar_categoria.php" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</main>

<?php
include "../layout/rodape.php";
?>
