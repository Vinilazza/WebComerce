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

    <label for="quantidade" class="form-label">Quantidade:</label>
    <input type="text" required class="form-control mb-4" name="quantidade">

    <label for="desccurta" class="form-label">Descrição Curta:</label>
    <input type="text" required class="form-control mb-4" name="desccurta">

    <label for="condicao" class="form-label">Condição:</label>
    <input type="text" required class="form-control mb-4" name="condicao">

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


    <label for="descricao" class="form-label">Descrição:</label>
    <textarea name="descricao" required id="descricao" class="form-control" cols="30" rows="10"></textarea>

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
                img.style.width = '100px'; // Ajuste o tamanho conforme necessário
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