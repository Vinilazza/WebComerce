<?php
    include "incs/header.php";
    require_once "admin/src/ProdutoDAO.php";

    $idproduto = $_REQUEST['idproduto']??null;
    $operacao = $_REQUEST['operacao']??null;

    $carrinho = $_SESSION['carrinho']??[];

    if($operacao == "inserir"){
        $existe = false;
        foreach ($carrinho as $i => $item) {
            if($idproduto == $item['idproduto']){
                $item['quantidade'] += 1;
                $carrinho[$i] = $item;
                $existe = true;
            }
        }

        if ($existe == false){
            $item['idproduto'] = $idproduto;
            $item['quantidade'] = 1;
            $carrinho[] = $item;   
        }
        
    }else
    if ($operacao == "remover"){

      for ($i=0; $i <= array_key_last($carrinho); $i++){
        $item = $carrinho[$i]??null;
        if($item != null && $item['idproduto'] == $idproduto){
          unset($carrinho[$i]);         
        }
      }
    }

    $_SESSION['carrinho'] = $carrinho;
?>

    <main class="container w-75 mt-5 py-2 ">
        
        <div class="col-10">
            <div class="container w-100">
                <h3 class="border-bottom border-dark mb-4 pb-1">Carrinho de Compras</h3>
                
                <?php
                  $produtoDAO = new ProdutoDAO();
                  $subtotal = 0;
                  $total = 0;
                  foreach($carrinho as $i => $item):
                    $produtoItem = $produtoDAO->consultarProdutoPorId($item['idproduto']);
                    $subtotal = $item['quantidade']*$produtoItem['preco'];
                    $total += $subtotal;
                    $item['preco']= $produtoItem['preco'];
                    $carrinho[$i] =$item;
                ?>

                <section class="border bottom border-dark rounded mb-5 fs-6">
                    <div class= "col-12 md-order-1">
                        <img src="data:image/png;base64,<?=base64_encode($produtoItem['imagem'])?>" class="rounded float-start m-3" width="150px">
                        </br>  
                            <h3><?=$produtoItem['nome']?></h3> 
                            <b class="fs-4"><?=number_format($produtoItem['preco'],2,",",".")?></b></br>
                            em até <?=$produtoItem['parcelas']?>x de R$ <?=$produtoItem['preco']/$produtoItem['parcelas']?> sem juros </br>
                            Em estoque </br>
                        </br>
                    </div>
                    <div class= "col-12  md-order-2">
                        <p><b>Quantidade: <?=$item['quantidade']?></b></p>
                        <a href="carrinho.php?idproduto=<?=$item['idproduto']?>&operacao=remover" class="text-decoration-none">
                        <div class="d-flex justify-content-center">
                        <button class="btn btn-danger text-center">Remover</button>
                        </div>
                        </a>

                    </div>
                </section>
                <?php
                  endforeach;
                ?>

                <div class="border bottom border-dark rounded">
                    <div class="fs-5 text-align-center">
                        <p>
                        <?php
                            $_SESSION['total'] = $total;
                            $_SESSION['carrinho'] = $carrinho;
                        ?>
                       <strong> Total: R$ <?=$total?> </strong>
                        </p>
                    </div>
                </div>
                    <div class="d-grid gap-2 mt-4">
                        <a class="btn btn-secondary" href="pagamento.php" type="button">Finalizar pedido</a>
                    </div>
            </div>
        </div>
    </main>

    <?php
    include "incs/footer.php";
?>
</body>