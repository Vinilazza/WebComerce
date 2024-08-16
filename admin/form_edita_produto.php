<?php
    include "topo.php";
    require_once('src/CategoriaDAO.php');
    require_once('src/ProdutoDAO.php');
    require_once('src/JoiaDAO.php');

    $categoriaDAO = new CategoriaDAO();
    $categorias = $categoriaDAO->consultarCategorias();

    $joiaDAO = new JoiaDAO();
    $joias = $joiaDAO->consultarJoias();

    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorID($_GET['idproduto']);
?>

    <h2>Cadastro de Produto</h2>
    <form method="POST" action="editar.php?idproduto=<?=$produto['idproduto']?>" enctype="multipart/form-data">

        <label for="nome" class="form-label">Nome:</label>
        <input type="text" required class="form-control mb-4" name="nome" value="<?=$produto['nome']?>">

        <label for="preco" class="form-label">Preço:</label>
        <input type="text" required class="form-control mb-4" name="preco" value="<?=$produto['preco']?>" >

        <label for="parcelas" class="form-label">Parcelas:</label>
        <input type="text" required class="form-control mb-4" name="parcelas" value="<?=$produto['parcelas']?>">

        <label for="edicao" class="form-label">Edição:</label>
        <input type="text" required class="form-control mb-4" name="edicao" value="<?=$produto['edicao']?>">

        <label for="colecao" class="form-label">Coleção:</label>
        <input type="text" required class="form-control mb-4" name="colecao" value="<?=$produto['colecao']?>">

        <label for="tipo" class="form-label">Categoria:</label>
        <select type="text" required class="form-select mb-4" name="tipo">
            <option value="" disabled selected>Selecione uma categoria</option>
            <?php
                if(sizeof($categorias) > 0){
                    foreach($categorias as $categoria){

                        $selected = '';

                        if($categoria['idcategoria'] == $produto['idcategoria']){
                            $selected = 'selected';
                        }

                        $id = $categoria['idcategoria'];
                        $nome = $categoria['categoria'];
                        echo "<option $selected  value='$id'>$nome</option>";
                    }
                }
            ?>
        </select>

        <label for="joia_produto" class="form-label">Jóia:</label>
        <select type="text" required class="form-select mb-4" name="joia_produto">
            <option value="" disabled selected>Selecione uma categoria</option>
            <?php
                if(sizeof($joias) > 0){
                    foreach($joias as $joia){

                        $selectedJoia = '';

                        if($joia['idjoia'] == $produto['idjoia']){
                            $selectedJoia = 'selected';
                        }

                        $id = $joia['idjoia'];
                        $nome = $joia['joia'];
                        echo "<option $selectedJoia value='$id'>$nome</option>";
                    }
                }
            ?>
        </select>

        <label for="imagem" class="form-label">Imagem:</label>
        <input type="file" class="form-control mb-4" name="imagem" required>

        <label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" required id="descricao" class="form-control" cols="30" rows="10"><?=$produto['descricao']?></textarea>

        <button class="btn btn-dark mt-4">Editar</button>


    </form>

<?php
include "rodape.php";
?>