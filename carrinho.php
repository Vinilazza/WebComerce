<?php
include "incs/header.php";
require_once "admin/src/ProdutoDAO.php";

$idproduto = $_REQUEST['idproduto'] ?? null;
$operacao = $_REQUEST['operacao'] ?? null;

$carrinho = $_SESSION['carrinho'] ?? [];

if ($operacao == "inserir") {
    $existe = false;
    foreach ($carrinho as $i => $item) {
        if ($idproduto == $item['idproduto']) {
            $item['quantidade'] += 1;
            $carrinho[$i] = $item;
            $existe = true;
        }
    }

    if ($existe == false) {
        $item['idproduto'] = $idproduto;
        $item['quantidade'] = 1;
        $carrinho[] = $item;
    }
} else
    if ($operacao == "remover") {

    for ($i = 0; $i <= array_key_last($carrinho); $i++) {
        $item = $carrinho[$i] ?? null;
        if ($item != null && $item['idproduto'] == $idproduto) {
            unset($carrinho[$i]);
        }
    }
}

$_SESSION['carrinho'] = $carrinho;
?>

<?php ?>
<main class="bg-light p-4">
    <section>
        <div class="container d-flex">
            <?php
            if (!$carrinho) {
            ?>
                <div class="col-8 bg-white d-flex rounded me-4 p-4 shadow-sm">
                    <div class="body w-100 d-flex justify-content-center align-items-center" style="height: 27.25rem;">
                        <div class="text-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="100" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <h1 style="font-size: 18px;">Monte um carrinho de compras!</h1>
                            <h1 style="font-size: 16px;">Adicione produtos e tenha frete grátis.</h1>
                            <button class="btn btn-primary " style="padding: 10px 26px;width:100%"><a href="/produtos.php" class="text-decoration-none text-white">Encontrar produtos!</a></button>
                        </div>

                    </div>
                </div>
                <div class="col-4 bg-white rounded p-4 shadow-sm opacity-75">
                    <div class="title mb-4">
                        <h5 class="fw-bold">Resumo da compra</h5>
                    </div>
                    <hr>
                    <div class="body mb-3">
                        <p>Aqui voce pode encontrar o resumo da sua compra!</p>
                    </div>
                    <div class="total d-flex justify-content-between fw-bold mb-4">
                    </div>
                </div>


            <?php
            } else {
            ?>
                <div class="col-8 bg-white rounded me-4 p-4 shadow-sm">

                    <div class="title mb-4">
                        <h5 class="fw-bold">Produtos </h5>
                        <hr>
                    </div>
                    <div class="body">
                        <?php
                        $produtoDAO = new ProdutoDAO();
                        $subtotal = 0;
                        $total = 0;

                        foreach ($carrinho as $i => $item):
                            $produtoItem = $produtoDAO->consultarProdutoPorId($item['idproduto']);
                            $imagem = $produtoDAO->consultarImagemPrincipal($item['idproduto']);

                            $subtotal = $item['quantidade'] * $produtoItem['preco'];
                            $total += $subtotal;
                            $item['preco'] = $produtoItem['preco'];
                            $carrinho[$i] = $item;
                        ?>
                            <section class="border-bottom pb-4 mb-4 d-flex">
                                <div class="col-3">
                                    <img src="data:image/png;base64,<?= base64_encode($imagem) ?>" class="img-fluid rounded">
                                </div>
                                <div class="col-9 ps-3">
                                    <h6><?= $produtoItem['nome'] ?></h6>
                                    <p class="text-muted mb-1">
                                        em até <?= $produtoItem['parcelas'] ?>x de R$ <?= number_format($produtoItem['preco'] / $produtoItem['parcelas'], 2, ",", ".") ?> sem juros
                                    </p>
                                    <p class="mb-1">Em estoque</p>
                                    <p class="fw-bold text-success mb-1">R$ <?= number_format($produtoItem['preco'], 2, ",", ".") ?></p>
                                    <div class="d-flex align-items-center">
                                        <span class="me-3">Quantidade: <?= $item['quantidade'] ?></span>
                                        <a href="carrinho.php?idproduto=<?= $item['idproduto'] ?>&operacao=remover" class="btn btn-danger btn-sm">Remover</a>
                                    </div>
                                </div>
                            </section>
                        <?php
                        endforeach;
                        ?>
                    </div>

                    <div class="frete text-muted py-2">
                        <p></p>
                    </div>
                </div>

                <div class="col-4 bg-white rounded p-4 shadow-sm">
                    <div class="title mb-4">
                        <h5 class="fw-bold">Resumo da compra</h5>
                    </div>
                    <div class="body mb-3">
                        <p class="mb-2 d-flex justify-content-between"><span class="text-start">Produto: </span><span class="fw-bold text-end">R$ <?= number_format($total, 2, ",", ".") ?></span></p>
                        <p class="mb-2 d-flex justify-content-between">Frete: <span class="text-success">Grátis</span></p>
                    </div>
                    <hr>
                    <div class="total d-flex justify-content-between fw-bold mb-4">
                        <span>Total</span>
                        <span>R$ <?= number_format($total, 2, ",", ".") ?></span>
                    </div>
                    <div class="d-grid">
                        <a href="pagamento.php" class="btn btn-primary btn-lg">Continuar a compra</a>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </section>
</main>




<?php
include "incs/footer.php";
?>
</body>