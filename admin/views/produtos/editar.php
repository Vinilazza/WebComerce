<?php
    include "../layout/topo.php";
    require_once('../../src/ProdutoDAO.php');
    require_once('../../src/funcao.php');
    $produtoDAO = new ProdutoDAO();
    $produtoDAO->editar($_POST, $_GET['idproduto']);
    ?>

<h1>Editado com sucesso!</h1>
<?php
    include "rodape.php";
    ?>