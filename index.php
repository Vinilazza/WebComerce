<?php
include "incs/header.php";
require_once "admin/src/ProdutoDAO.php";
require_once "admin/src/ClienteDAO.php";
require_once "admin/src/CategoriaDAO.php";

$clienteDAO = new ClienteDAO();
$clienteDAO->registrarVisita();

$categoriaDAO = new CategoriaDAO();
$produtoDAO = new ProdutoDAO();

$categorias = $categoriaDAO->consultarCategorias();

$categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8; // número de produtos por página
$offset = ($page - 1) * $limit;

if ($categoriaSelecionada) {
    $produtos = $produtoDAO->consultarProdutosPorCategoria($categoriaSelecionada, $limit, $offset);
    $totalProdutos = $produtoDAO->contarProdutosPorCategoria($categoriaSelecionada);
} else {
    $produtos = $produtoDAO->consultarProdutos($limit, $offset);
    $totalProdutos = $produtoDAO->contarProdutos();
}

$totalPaginas = ceil($totalProdutos / $limit);
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/bannner0.jpg" class="img-slide img1-position d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/banner2.png" class="img-slide img2-position d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/banner3.png" class="img-slide img3-position d-block w-100" alt="...">
    </div>
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
    <br><br>
    <h2>Produtos de Luxo</h2>
    <br><br>

    <!-- Filtros de Categoria -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h4>Categorias</h4>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Todas</a>
                    </li>
                    <?php foreach ($categorias as $categoria): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?categoria=<?= $categoria['idcategoria'] ?>"><?= $categoria['categoria'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
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
                        <div class="badge bg-danger position-absolute top-0 start-0 m-2">10% OFF</div>
                        
                        <!-- Imagem do Produto -->
                        <img src="data:image/png;base64,<?= base64_encode($imagem) ?>" class="card-img-top img-barbie" alt="...">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= $p['nome'] ?></h5>
                            <!-- Preço antigo -->
                            <span class="text-muted text-decoration-line-through price-old">R$ <?= number_format(($p['preco'] * 1.1), 2, ",", ".") ?></span><br>
                            <span class="price">R$ <?= number_format($p['preco'], 2, ",", ".") ?></span><br>
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
