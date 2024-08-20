<?php
    include "incs/header.php";
    require_once "admin/src/ProdutoDAO.php";

    $produtoDAO = new ProdutoDAO();
    $idproduto = $_GET['idproduto'];
    $produto = $produtoDAO->consultarProdutoPorID($idproduto);
    $imagens = $produtoDAO->consultarImagensPorProduto($idproduto); // Obtém todas as imagens associadas
    
    // Identifica a imagem principal
    $imagemPrincipalId = null;
    foreach ($imagens as $imagem) {
        if ($imagem['principal']) {
            $imagemPrincipalId = $imagem['id'];
            break;
        }
    }
?>

<main class="container">
    <form action="carrinho.php" method="POST">
        <input type="hidden" name="idproduto" value="<?= htmlspecialchars($idproduto) ?>">
        <input type="hidden" name="operacao" value="inserir">

        <div class="container row py-5">
            <div class="col-6">
                <div id="produtoCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($imagens as $index => $imagem): ?>
                            <div class="carousel-item <?= $imagem['id'] === $imagemPrincipalId ? 'active' : '' ?>">
                                <img src="data:image/png;base64,<?= base64_encode($imagem['imagem']) ?>" class="d-block w-100" alt="Imagem do produto">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#produtoCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next text-dark" type="button" data-bs-target="#produtoCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h2 class="fnt-price"><?= htmlspecialchars($produto['nome']) ?></h2>
                    </div>
                    <div class="col-12 fnt-price">
                        <p style="font-size: 14px">Vendido e entregue por: <b>VLTECH INFORMATICA!</b> | Em estoque (<?=$produto['quantidade']?>)</p>
                        <?php if ($produto['em_oferta']): ?>
                            <h4 class="fnt-price price" style="font-size: 40px"><b>R$ <?= number_format($produto['valor_oferta'], 2, ",", ".") ?></b></h4>
                            <h6 style="font-size: 14px">À vista no PIX com até <?= round((($produto['preco'] - $produto['valor_oferta']) / $produto['preco']) * 100) ?>% OFF</h6>
                            <span class="text-muted text-decoration-line-through price-old">R$ <?= number_format($produto['preco'], 2, ",", ".") ?></span>
                        <?php else: ?>
                            <h4 class="fnt-price price" style="font-size: 40px"><b>R$ <?= number_format($produto['preco'], 2, ",", ".") ?></b></h4>
                        <?php endif; ?>
                        <h6 style="font-size: 14px">Em até <?=$produto['parcelas']?>x de R$ <b><?= number_format($produto['preco']/$produto['parcelas'], 2, ",", ".") ?></b> sem juros no cartão</h6>
                        <h6 style="font-size: 14px">Ou em 1x no cartão com até 5% OFF</h6>
                    </div>
                </div>
                <div class="my-5">
                    <h5>Descrição Técnica</h5>
                    <p><?= htmlspecialchars($produto['descricao_tecnica']) ?></p>
                    <h5>Descrição do Produto</h5>
                    <p><?= htmlspecialchars($produto['descricao_produto']) ?></p>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark text-light w-100">ADICIONAR AO CARRINHO</button>
                </div>
            </div>
        </div> 
    </form>
</main>

<?php
    include "incs/footer.php";
?>
