<?php
    include "../layout/topo.php";
    require_once('../../src/CategoriaDAO.php');
    require_once('../../src/ProdutoDAO.php');
    require_once('../../src/JoiaDAO.php');

    $categoriaDAO = new CategoriaDAO();
    $categorias = $categoriaDAO->consultarCategorias();

    $joiaDAO = new JoiaDAO();
    $joias = $joiaDAO->consultarJoias();

    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorID($_GET['idproduto']);
?>

    <h2>Cadastro de Produto</h2>
    <form method="POST" action="editar.php?idproduto=<?=$produto['idproduto']?>" enctype="multipart/form-data">

        <label for="nome" class="form-label">Nome:</label>
        <input type="text" required class="form-control mb-4" name="nome" value="<?=$produto['nome']?>">

        <label for="email" class="form-label">Email:</label>
        <input type="text" required class="form-control mb-4" name="preco" value="<?=$produto['preco']?>" >

        <label for="senha" class="form-label">Senha:</label>
        <input type="text" required class="form-control mb-4" name="senha" value="<?=$produto['senha']?>">

        <button class="btn btn-dark mt-4">Editar</button>


    </form>

<?php
include "../layout/rodape.php";
?>