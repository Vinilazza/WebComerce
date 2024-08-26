<?php
include "incs/header.php";

require_once "admin/src/ProdutoDAO.php";
require_once "admin/src/ClienteLogDAO.php";


if (isset($_GET['query'])) {
    try {
        $searchTerm = htmlspecialchars($_GET['query']);

        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->consultarPorChave($searchTerm);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
if(isset($_SESSION["idcliente"]) ){
    $ClienteLog = new ClienteLogDAO();
$ClienteLog->registrarLog($_SESSION['idcliente'], "/query/$searchTerm");
}

?>

<main class="container w-74 mt-5" style="height: 64vh">

    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 g-4">
        <?php if ($produto): ?>
            <?php foreach ($produto as $p) :
                $imagem = $produtoDAO->consultarImagemPrincipal($p['idproduto']);
            ?>
                <div class="col">
                    <a href="paginaproduto.php?idproduto=<?= $p['idproduto'] ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 w-100 position-relative card-item hvr-shadow">
                            <!-- Desconto -->
                            <div class="badge bg-danger position-absolute top-0 start-0 m-2"><?= round((($p['preco_parcelado'] - $p['preco_avista']) / $p['preco_parcelado']) * 100) ?>% OFF</div>

                            <!-- Imagem do Produto -->
                            <img src="data:image/png;base64,<?= base64_encode($imagem) ?>" class="card-img-top img-barbie" data-bs-target="adult" met alt="...">

                            <div class="card-body">
                                <h5 class="card-title"><?= $p['nome'] ?></h5>
                                <!-- Preço antigo -->
                                <span class="text-muted text-decoration-line-through price-old">R$ <?= number_format(($p['preco_parcelado']), 2, ",", ".") ?></span><br>
                                <span class="price">R$ <?= number_format($p['preco_avista'], 2, ",", ".") ?></span><br>
                                <span class="text-secondary avista">À Vista no PIX</span>
                                <!-- Botão de Comprar -->
                                <a href="paginaproduto.php?idproduto=<?= $p['idproduto'] ?>" class="btn-buy text-decoration-none mt-1">Comprar</a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
    <div class="container w-100">
        <div class="d-flex align-items-center justify-content-center" style="height: 64vh">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="70" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <h3>Não conseguimos encontrar resultados para a sua busca</h3>
                <a href="/index.php"><button class="btn btn-success mt-3">Encontre mais produtos</button></a>
            </div>
        </div>
    </div>
<?php endif ?>

    </div>
</main>

<?php include "incs/footer.php"; ?>