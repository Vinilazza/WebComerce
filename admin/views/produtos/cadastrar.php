<?php
    include "../layout/topo.php";
    require_once('../../src/ProdutoDAO.php');
    require_once('../../src/funcao.php');
    $produtoDAO = new ProdutoDAO();
    $produtoDAO->cadastrar($_POST);
    ?>

<h1>Cadastrado com sucesso!</h1>
<?php
    include "../layout/rodape.php";
    ?>