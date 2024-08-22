<?php
require_once('../../src/ConexaoBD.php');
require_once('../../src/ProdutoDAO.php');
require_once('../../src/ValorProdutoDAO.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extrair os dados do formulário
    $nome = $_POST['nome'];
    $custo_produto = $_POST['custo_produto'];
    $margem_produto_id = $_POST['margem_produto'];
    $parcelas = $_POST['parcelas'];
    $quantidade = $_POST['quantidade'];
    $descricao_tecnica = $_POST['descricao_tecnica'];
    $descricao_produto = $_POST['descricao_produto'];
    $condicao = $_POST['condicao'];
    $tipo = $_POST['tipo'];
    $imagem_principal = $_POST['imagem_principal'];

    // Pega a margem selecionada
    $valorProdutoDAO = new ValorProdutoDAO();
    $margem = $valorProdutoDAO->consultarMargemPorID($margem_produto_id)['margem'];

    // Calcula os preços
    $preco_avista = $custo_produto * (1 + $margem / 100);
    $preco_parcelado = $preco_avista * 1.05; // Ajuste conforme sua lógica

    // Preparar os dados para o método cadastrar
    $dados = [
        'nome' => $nome,
        'preco_avista' => $preco_avista,
        'preco_parcelado' => $preco_parcelado,
        'parcelas' => $parcelas,
        'quantidade' => $quantidade,
        'descricao_tecnica' => $descricao_tecnica,
        'descricao_produto' => $descricao_produto,
        'condicao' => $condicao,
        'tipo' => $tipo,
        'imagem_principal' => $imagem_principal,
        'custo_produto' => $custo_produto,
        'margem_produto_id' => $margem_produto_id
    ];

    // Inserir o produto no banco de dados
    $produtoDAO = new ProdutoDAO();
    $produtoDAO->cadastrar($dados);

    header('Location: form_lista_produtos.php'); // Redireciona para a lista de produtos após o cadastro
    exit;
}
