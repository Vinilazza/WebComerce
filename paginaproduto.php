<?php
    include "incs/header.php";
    require_once "admin/src/ProdutoDAO.php";

    $produtoDAO = new ProdutoDAO();
    $idproduto = $_GET['idproduto'];
    $produto = $produtoDAO->consultarProdutoPorID($idproduto);
?>

<main class="container">
    <form action="carrinho.php" method="POST">
        <input type="hidden" name="idproduto" value="<?=$idproduto?>">
        <input type="hidden" name="operacao" value="inserir">


           <div class="container row py-5">
        
                <div class="col-3">
                    <div class="card ">
                        <img src="data:image/png;base64,<?=base64_encode($produto['imagem'])?>" class="card-img-top py-3" title="colarrapunzel" alt="...">
                    </div>
                </div>
        
                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            <h2><?=$produto['nome']?></h2>
                        </div>
                        <div class="col-12">
                            <h4><b>R$<?=number_format($produto['preco'],2,",",".")?></b></h4>
                        </br>
                            <p><b>Edição limitada</b></p>
                            <p>Coleção inverno 2022</p>
                            <h6>Em até 6x de R$275,00</h6>
                            
                        </div>
                    </div>
                </div>
            <div class="my-5">
                <?=$produto['descricao']?>
            </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-dark text-light w-100">ADICIONAR AO CARRINHO</button>
                </div>
            </div> 
        </form>
    </main>

        </br>
        </br>
        </br>
        </br>
<?php
    include "incs/footer.php";
?>

    </body>
</html>