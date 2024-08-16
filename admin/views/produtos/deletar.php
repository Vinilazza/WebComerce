<?php

require_once('../../src/ProdutoDAO.php');
require_once('../../src/ConexaoBD.php');
$produtoDAO = new ProdutoDAO();
$produtoDAO->deletar($_GET['idproduto']);

header("Location: form_lista_produtos.php");