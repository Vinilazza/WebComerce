<?php

    include "../layout/topo.php";
    require_once('../../src/CategoriaDAO.php');
    require_once('../../src/JoiaDAO.php');

    $categoriaDAO = new CategoriaDAO();
    $categorias = $categoriaDAO->consultarCategorias();

    $joiaDAO = new JoiaDAO();
    $joias = $joiaDAO->consultarJoias();
?>

    <h2>Cadastro de Produto</h2>
    <form method="POST" action="cadastrar.php" enctype="multipart/form-data">

        <label for="nome" class="form-label">Nome:</label>
        <input type="text" required class="form-control mb-4" name="nome">

        <label for="preco" class="form-label">Preço:</label>
        <input type="text" required class="form-control mb-4" name="preco">

        <label for="parcelas" class="form-label">Parcelas:</label>
        <input type="text" required class="form-control mb-4" name="parcelas">

        <label for="edicao" class="form-label">Edição:</label>
        <input type="text" required class="form-control mb-4" name="edicao">

        <label for="colecao" class="form-label">Coleção:</label>
        <input type="text" required class="form-control mb-4" name="colecao">

        <label for="tipo" class="form-label">Categoria:</label>
        <select type="text" required class="form-select mb-4" name="tipo">
            <option value="" disabled selected>Selecione uma categoria</option>
            <?php
                if(sizeof($categorias) > 0){
                    foreach($categorias as $categoria){
                        $id = $categoria['idcategoria'];
                        $nome = $categoria['categoria'];
                        echo "<option value='$id'>$nome</option>";
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
                        $id = $joia['idjoia'];
                        $nome = $joia['joia'];
                        echo "<option value='$id'>$nome</option>";
                    }
                }
            ?>
        </select>

        <label for="imagem" class="form-label">Imagem:</label>
        <input type="file" class="form-control mb-4" name="imagem" required>

        <label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" required id="descricao" class="form-control" cols="30" rows="10"></textarea>

        <button class="btn btn-dark mt-4">Cadastrar</button>


    </form>

<?php
include "../layout/rodape.php";
?>