<?php
include "incs/header.php";
require_once "admin/src/ProdutoDAO.php";
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
<main>
  <main class="container w-74 mt-5">
    <!--produto-->
<br></br>
<h2>Produtos de Luxo</h2>
<br></br>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
      <?php
      $produtoDAO = new ProdutoDAO();
      $produtos = $produtoDAO->consultarColecao("Luxo");
      foreach ($produtos as $p) :
      ?>
        <div class="col">
          <a href="paginaproduto.php?idproduto=<?=$p['idproduto']?>" class="text-decoration-none text-dark ">
            <div class="card h-100">
              <img src="data:image/png;base64,<?=base64_encode($p['imagem'])?>" class="card-img-top img-barbie" alt="...">
              <div class="card-body">
              <h5 class="card-title"><?=$p['nome']?></h5>
                <p class="card-text"><?=$p['descricao'] ?></p>
                <p class="card-text text-success">R$ <?=number_format($p['preco'], 2,",",".")?></p>
                <a href="paginaproduto.php?idproduto=<?=$p['idproduto']?>" class="btn btn-dark mt-3"> Comprar</a>
              </div>
            </div>
          </a>
        </div>
      <?php
      endforeach;
      ?>
    </div>

<br></br>
<h2>Todas as Coleções</h2>
<br></br>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
      <?php
      $produtoDAO = new ProdutoDAO();
      $produtos = $produtoDAO->consultarProdutos();
      foreach ($produtos as $p) :
      ?>
        <div class="col">
          <a href="paginaproduto.php?idproduto=<?=$p['idproduto']?>" class="text-decoration-none text-dark ">
            <div class="card h-100">
              <img src="data:image/png;base64,<?=base64_encode($p['imagem'])?>" class="card-img-top img-barbie" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?=$p['nome']?></h5>
                <p class="card-text"><?=$p['descricao'] ?></p>
                <p class="card-text text-success">R$ <?=number_format($p['preco'], 2,",",".")?></p>
                <a href="paginaproduto.php?idproduto=<?=$p['idproduto']?>" class="btn btn-dark mt-3"> Comprar</a>
              </div>
            </div>
          </a>
        </div>
      <?php
      endforeach;
      ?>
    </div>

  </main>
  <script src="js/bootstrap.bundle.min.js"></script>
  </body>

  </html>
</main>

<?php
include "incs/footer.php";
?>