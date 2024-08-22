<?php
    include "../layout/topo.php";    
    require_once("../../src/ProdutoDAO.php");
    
    
    if (isset($_GET['mensagem']))
        $mensagem = $_GET['mensagem'];
    
    $produtoDAO = new ProdutoDAO();
    if(isset($_GET['idproduto'])){
        $produtoDAO->deletar($_GET['idproduto']);
        $mensagem = "Produto removido com sucesso";
    }

    if(isset($_GET['chave'])){
        $produtos = $produtoDAO->consultarPorChave($_GET['chave']);
    }else
        $produtos = $produtoDAO->consultarProdutos();
    if (isset($mensagem)){
?>  
    <div class="alert alert-primary mb-5" role="alert">
        <?=$mensagem?>
    </div>

<?php
    }else{
?>
        <div class="alert mb-5" role="alert">
        </div>
<?php
}


?>

    <div class="d-flex">
    <form action="form_lista_produtos.php" class="container w-50 my-0 borde roundend p-3 ">
        <div class="mb-2">
            <label class="form-label">Buscar por Nome</label>
            <input type="text" name="chave" class="form-control">
        </div>

        <div class="mb-2">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </div>
    </div>

    <table>
        <tr>            
            <th>Imagem</th>
            <th>ID</th>
            <th>Nome do produto</th>
            <th>Preço a vista</th>
            <th>Preço a prazo</th>
            <th></th>
        </tr>
                
        <?php
        if(sizeof($produtos) > 0){
            foreach($produtos as $produto){
                include("../../componentes/produto.php");
            }
        }  else {?>
            <tr>
                <td>Não foi encontrado produtos</td>
            </tr>
        <?php
        }
        ?>
        

    </table>    


<?php
    include "../layout/rodape.php";
?>