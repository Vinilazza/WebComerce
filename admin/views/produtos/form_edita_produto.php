<?php

include "../layout/topo.php";
require_once('../../src/CategoriaDAO.php');
require_once('../../src/ValorProdutoDAO.php');
require_once('../../src/produtoDAO.php');

$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->consultarCategorias();

$valorProdutoDAO = new ValorProdutoDAO();
$margens = $valorProdutoDAO->listarMargens();

$idproduto = $_GET['idproduto'];
$produtoDAO = new produtoDAO();
$produto = $produtoDAO->consultarProdutoPorID($idproduto);

?>

<h2>Edição de produto</h2>
<form method="POST" action="editar.php" enctype="multipart/form-data">

    <input type="hidden" name="idproduto" value="<?=$idproduto?>">

    <label for="nome" class="form-label">Nome:</label>
    <input type="text" required class="form-control mb-4" name="nome" value="<?=$produto['nome']?>">

    <label for="custo_produto" class="form-label">Custo do Produto:</label>
    <input type="text" required class="form-control mb-4" name="custo_produto" value="<?=$produto['custo_produto']?>">

    <label for="margem_produto" class="form-label">Margem de Lucro:</label>
    <select type="text" required class="form-select mb-4" name="margem_produto">
        <option value="" disabled selected>Selecione a margem</option>
        <?php
        foreach ($margens as $margem) {
            $id = $margem['id'];
            $nome = $margem['nome'];
            echo "<option value='$id'>$nome</option>";
        }
        ?>
    </select>

    <label for="parcelas" class="form-label">Parcelas:</label>
    <input type="text" required class="form-control mb-4" name="parcelas" value="<?=$produto['parcelas']?>">

    <label for="quantidade" class="form-label">Quantidade:</label>
    <input type="text" required class="form-control mb-4" name="quantidade" value="<?=$produto['quantidade']?>">

    <label for="descricao_tecnica" class="form-label">Descrição Técnica:</label>
    <textarea name="descricao_tecnica" required id="descricao" class="form-control" cols="30" rows="10"><?=$produto['descricao_tecnica']?></textarea>

    <label for="descricao_produto" class="form-label">Descrição do Produto:</label>
    <textarea name="descricao_produto" required id="descricao" class="form-control" cols="30" rows="10" ><?=$produto['descricao_produto']?></textarea>

    <label for="condicao" class="form-label">Condição:</label>
    <select name="condicao" required class="form-select mb-4">
        <option value="" disabled selected>Selecione a condição</option>
        <option value="Novo">Novo</option>
        <option value="Usado">Usado</option>
    </select>

    <label for="tipo" class="form-label">Categoria:</label>
    <select type="text" required class="form-select mb-4" name="tipo">
        <option value="" disabled selected>Selecione uma categoria</option>
        <?php
        if (sizeof($categorias) > 0) {
            foreach ($categorias as $categoria) {
                $id = $categoria['idcategoria'];
                $nome = $categoria['categoria'];
                echo "<option value='$id'>$nome</option>";
            }
        }
        ?>
    </select>

    <label for="imagem" class="form-label">Imagem:</label>
    <input type="file" class="form-control mb-4" name="imagens[]" id="imagem" multiple required>
    <div id="image-preview" class="mb-4"></div>

    <label for="imagem_principal" class="form-label">Selecione a imagem principal:</label>
    <select class="form-select mb-4" id="imagem_principal" name="imagem_principal" required>
        <option value="" disabled selected>Selecione uma imagem</option>
    </select>

    <button class="btn btn-dark mt-4">Cadastrar</button>

</form>

<script>
    document.getElementById('imagem').addEventListener('change', function(event) {
        var imagePreview = document.getElementById('image-preview');
        var imagemPrincipal = document.getElementById('imagem_principal');

        imagePreview.innerHTML = '';
        imagemPrincipal.innerHTML = '<option value="" disabled selected>Selecione uma imagem</option>';

        var files = event.target.files;
        Array.from(files).forEach((file, index) => {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.marginRight = '10px';

                var label = document.createElement('label');
                label.appendChild(img);

                var option = document.createElement('option');
                option.value = index;
                option.textContent = 'Imagem ' + (index + 1);

                imagemPrincipal.appendChild(option);
                imagePreview.appendChild(label);
            };

            reader.readAsDataURL(file);
        });
    });
</script>

<?php
include "../layout/rodape.php";
?>
