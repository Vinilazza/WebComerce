<?php
require_once __DIR__ . '/vendor/autoload.php';


include "incs/header.php";
require_once "admin/src/ProdutoDAO.php";
require_once "admin/src/ClienteDAO.php";
require_once "admin/src/CategoriaDAO.php";
require_once "admin/src/BannerDAO.php";
require_once "admin/src/ClienteLogDAO.php";

if(isset($_SESSION["idcliente"]) ){
    $ClienteLog = new ClienteLogDAO();
$ClienteLog->registrarLog($_SESSION['idcliente'], '/index');
}


$clienteDAO = new ClienteDAO();
$clienteDAO->registrarVisita();

$categoriaDAO = new CategoriaDAO();
$produtoDAO = new ProdutoDAO();


$bannerDAO = new BannerDAO();
$banners = $bannerDAO->listarBanners();

$categorias = $categoriaDAO->consultarCategorias();

$categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8; // número de produtos por página
$offset = ($page - 1) * $limit;

if ($categoriaSelecionada) {
    $produtos = $produtoDAO->consultarProdutosPorCategoria($categoriaSelecionada, $limit, $offset);
    $totalProdutos = $produtoDAO->contarProdutosPorCategoria($categoriaSelecionada);
} else {
    $produtos = $produtoDAO->consultarProdutos();
    $totalProdutos = $produtoDAO->contarProdutos();
}

$totalPaginas = ceil($totalProdutos / $limit);
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($banners as $index => $banner): ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($banners as $index => $banner): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <a href="<?= htmlspecialchars($banner['link']) ?>" class="">
            
                <img src="data:image/jpeg;base64,<?= base64_encode($banner['imagem']) ?>" class="img-slide img1-position d-block w-100" alt="<?= htmlspecialchars($banner['titulo']) ?>">
                <?php if ($banner['titulo'] || $banner['link']): ?>
                    <div class="carousel-caption d-none d-md-block">
                        <?php if ($banner['titulo']): ?>
                        <?php endif; ?>
                        <?php if ($banner['link']): ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                            </a>    
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</header>

<!--parte central-->
<main class="container w-74 mt-5">


    <div id="carouselExampleFade" class="carousel slide">
        <div class="carousel-inner ">
            <?php
            $chunks = array_chunk($categorias, 6); // Divida as categorias em grupos de 4
            foreach ($chunks as $index => $chunk) :
            ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <div class="row d-flex justify-content-center hvr-shadow">
                        <?php
                        foreach ($chunk as $categoria):
                            $isActive = ($categoriaSelecionada == $categoria['idcategoria']) ? 'active-category' : '';
                        ?>
                            <div class="col-md-2 hrv hvr-shadow">
                                <a href="index.php?categoria=<?= $categoria['idcategoria'] ?>" class="text-decoration-none text-dark <?= $isActive ?>">
                                    <div class="card h-100 w-100 p-3 shadow-sm ">
                                        <img src="data:image/png;base64,<?= base64_encode($categoria['imagem']) ?>" class="img-fluid rounded w-100" alt="<?= htmlspecialchars($categoria['categoria']) ?>">
                                        <div class="card-body text-center">
                                            <h5 class="card-title cd-title text-wrap" ><?= htmlspecialchars($categoria['categoria']) ?></h5>
                                            <a href="index.php?categoria=<?= $categoria['idcategoria'] ?>" style="font-size:16px;" class="text-decoration-none text-dark">Ver Produtos</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
        <button class="carousel-control-prev2" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon2" aria-hidden="true"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
            </svg>
        </button>
        <button class="carousel-control-next2" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
            </svg>
        </button>
    </div>

    <br><br>
    <h2>Todas as Coleções</h2>
    <br><br>
    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 g-4">
        <?php foreach ($produtos as $p) :
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
    </div>

    <!-- Paginação -->
    <div class="container mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?page=<?= $i ?>&categoria=<?= $categoriaSelecionada ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</main>

<?php include "incs/footer.php"; ?>