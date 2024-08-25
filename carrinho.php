<?php
include "incs/header.php";
require_once "admin/src/ProdutoDAO.php";

$idproduto = $_REQUEST['idproduto'] ?? null;
$operacao = $_REQUEST['operacao'] ?? null;
$quantidade = $_REQUEST['quantidade'] ?? null;

$carrinho = $_SESSION['carrinho'] ?? [];

if ($operacao == "inserir") {
    $existe = false;
    
    // Consultar o produto para verificar a quantidade em estoque
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($idproduto);
    $estoqueAtual = $produto['quantidade']; // Supondo que 'estoque' seja o campo no banco de dados
    
    foreach ($carrinho as $i => $item) {
        if ($idproduto == $item['idproduto']) {
            if ($item['quantidade']<= $estoqueAtual) { // Verifica se tem estoque suficiente
                $carrinho[$i] = $item;
            } else {
                echo "<script>document.querySelectorAll('.btn-add').disabled = true</script>";
            }
            $existe = true;
        }
    }

    if (!$existe) {
        if ($estoqueAtual > 0) { // Verifica se o estoque é suficiente para adicionar o item
            $item['idproduto'] = $idproduto;
            $item['quantidade'] = 1;
            $carrinho[] = $item;
        } else {
            // Mensagem de erro ou manipulação do caso sem estoque
            echo "<script>alert('Produto fora de estoque.');</script>";
        }
    }
} elseif ($operacao == "remover") {
    foreach ($carrinho as $i => $item) {
        if ($item['idproduto'] == $idproduto) {
            unset($carrinho[$i]);
            break;
        }
    }
} elseif ($operacao == "atualizar" && $quantidade !== null) {
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($idproduto);
    $estoqueAtual = $produto['quantidade'];

    foreach ($carrinho as $i => $item) {
        if ($item['idproduto'] == $idproduto) {
            if ($quantidade <= $estoqueAtual) { // Verifica se a quantidade solicitada não excede o estoque
                $item['quantidade'] = (int)$quantidade;
                $carrinho[$i] = $item;
            } else {
                // Mensagem de erro ou manipulação do caso sem estoque
                echo "<script>alert('Quantidade solicitada excede o estoque disponível.');</script>";
            }
            break;
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
                            <button class="btn btn-primary " style="padding: 10px 26px;width:100%"><a href="/index.php" class="text-decoration-none text-white">Encontrar produtos!</a></button>
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

                            $subtotal = $item['quantidade'] * $produtoItem['preco_avista'];
                            $total += $subtotal;
                            $item['preco_avista'] = $produtoItem['preco_avista'];
                            $carrinho[$i] = $item;
                        ?>
                            <section class="border-bottom pb-4 mb-4 d-flex">
                                <div class="col-3">
                                    <img src="data:image/png;base64,<?= base64_encode($imagem) ?>" class="img-fluid rounded">
                                </div>
                                <div class="col-9 ps-3">
                                <h6><?= $produtoItem['nome'] ?></h6>

                                <div class="d-flex">
                                <a href="carrinho.php?idproduto=<?= $item['idproduto'] ?>&operacao=remover" class="text-decoration-none me-2">Excluir</a>
                                </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="justify-content-start">
                                        <div class="input-group" style="width: 110px;border-radius: 6px;border: 1px solid rgba(0, 0, 0, .25);">
                                        <button class="btn btn-subtract" type="button" data-id="<?= $item['idproduto'] ?>">-</button>
                                        <input type="number" class="form-control text-center item-quantity" style="border:none;" min="1" value="<?= $item['quantidade'] ?>">
                                        <button class="btn btn-add" type="button" data-id="<?= $item['idproduto'] ?>">+</button>
                                    </div>
                                        </div>
                                        <div class="justify-content-end">
                                        <p class=" text-dark mb-1" style="font-size: 20px;">R$ <?= number_format($produtoItem['preco_avista'], 2, ",", ".") ?></p>

                                        </div>

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



<script>
    document.querySelectorAll(".btn-subtract").forEach(button => {
        button.addEventListener("click", function() {
            const quantityInput = this.closest('.d-flex').querySelector('.item-quantity');
            let quantity = parseInt(quantityInput.value);
            let minimum = 1;
            if (quantity > minimum) {
                quantity--;
                quantityInput.value = quantity;
                updateCart(this.dataset.id, quantity);
            }
        });
    });

    document.querySelectorAll(".btn-add").forEach(button => {
        button.addEventListener("click", function() {
            const quantityInput = this.closest('.d-flex').querySelector('.item-quantity');
            let quantity = parseInt(quantityInput.value);

            quantity++;
            quantityInput.value = quantity;
            updateCart(this.dataset.id, quantity);
        });
    });

    function updateCart(productId, quantity) {
        // Faz a requisição para atualizar o carrinho
        fetch(`carrinho.php?operacao=atualizar&idproduto=${productId}&quantidade=${quantity}`)
            .then(response => response.text())
            .then(data => {
                // Recarrega a página ou atualiza o carrinho na página sem recarregar
                location.reload();
            })
            .catch(error => console.error('Erro ao atualizar o carrinho:', error));
    }
</script>

<?php
include "incs/footer.php";
?>
</body>