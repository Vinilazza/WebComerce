<?php
include "incs/header.php";
require_once "admin/src/ProdutoDAO.php";

require_once "admin/src/ClienteLogDAO.php";


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
if (isset($_SESSION["idcliente"])) {
    $ClienteLog = new ClienteLogDAO();
    $ClienteLog->incrementarVisitasProduto($idproduto);
    $ClienteLog->registrarLog($_SESSION['idcliente'], "$idproduto");
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
                            <div class="carousel-item rounded <?= $imagem['id'] === $imagemPrincipalId ? 'active' : '' ?>">
                                <img src="data:image/png;base64,<?= base64_encode($imagem['imagem']) ?>" class="d-block w-100" alt="Imagem do produto">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev3" type="button" data-bs-target="#produtoCarousel" data-bs-slide="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                        </svg>
                    </button>
                    <button class="carousel-control-next3" type="button" data-bs-target="#produtoCarousel" data-bs-slide="next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h2 class="fnt-price"><?= htmlspecialchars($produto['nome']) ?></h2>
                    </div>
                    <div class="col-12 fnt-price">
                        <p style="font-size: 14px">Vendido e entregue por: <b>VLTECH INFORMATICA!</b> | Em estoque (<?= $produto['quantidade'] ?>)</p>
                        <?php if ($produto['em_oferta']): ?>

                            <h4 class="fnt-price price" style="font-size: 40px"><b>R$ <?= number_format($produto['preco_avista'], 2, ",", ".") ?></b></h4>
                            <h6 style="font-size: 14px">À vista no PIX com até <?= round((($produto['preco_parcelado'] - $produto['preco_avista']) / $produto['preco_parcelado']) * 100) ?>% OFF</h6>
                            <span class="text-decoration-line price-old"><b>R$ <?= number_format($produto['preco_parcelado'], 2, ",", ".") ?></b></span>
                        <?php else: ?>
                            <h4 class="fnt-price price" style="font-size: 40px"><b>R$ <?= number_format($produto['preco_avista'], 2, ",", ".") ?></b></h4>
                        <?php endif; ?>
                        <h6 style="font-size: 14px">Em até <?= $produto['parcelas'] ?>x de R$ <b><?= number_format($produto['preco_parcelado'] / $produto['parcelas'], 2, ",", ".") ?></b> sem juros no cartão</h6>
                        <h6 style="font-size: 14px">Ou em 1x no cartão com até <?= round((($produto['preco_parcelado'] - $produto['preco_avista']) / $produto['preco_parcelado']) * 100) ?>% OFF</h6>
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