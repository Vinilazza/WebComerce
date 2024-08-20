<?php
ob_start();
include "../layout/topo.php";
require_once('../../src/CategoriaDAO.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoriaDAO = new CategoriaDAO();

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nome = $_POST['nome'];

        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $categoriaDAO->adicionarCategoria($nome,$imagem);

    } else {
        // Tratamento de erro, caso o upload não tenha sido bem-sucedido
        die("Erro no upload da imagem.");
    }
    
    // Redireciona para a lista de categorias após o cadastro
    header("Location: listar_categorias.php");
    exit();
}
ob_end_flush();
?>

<main class="container">
    <h2 class="my-4">Cadastrar Nova Categoria</h2>
    <form action="cadastrar_categoria.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem da Categoria</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</main>

<?php
include "../layout/rodape.php";
?>