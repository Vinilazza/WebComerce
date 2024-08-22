<?php
ob_start();
include "../layout/topo.php";
require_once('../../src/CategoriaDAO.php');

$categoriaDAO = new CategoriaDAO();

if (isset($_POST['delete'])) {
    $idcategoria = $_POST['idcategoria'];
    $categoriaDAO->deletarCategoria($idcategoria);
    header("Location: listar_categorias.php");
    exit;
}

if (isset($_POST['edit'])) {
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $idcategoria = $_POST['idcategoria'];
        $nomeCategoria = $_POST['nome_categoria'];
        $categoriaDAO->editarCategoria($idcategoria, $nomeCategoria, $imagem);
        header("Location: listar_categorias.php");

    } else {
        // Tratamento de erro, caso o upload não tenha sido bem-sucedido
        die("Erro no upload da imagem.");
    }

    exit;
}

$categorias = $categoriaDAO->consultarCategorias();
ob_end_flush();
?>

<main class="container">
    <h2 class="my-4">Categorias</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome da Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?= $categoria['idcategoria'] ?></td>
                    <td><?= $categoria['categoria'] ?></td>
                    <td>
                        <!-- Botão para Editar -->
                        <button class="btn btn-primary btn-sm" data-id="<?= $categoria['idcategoria'] ?>" data-nome="<?= $categoria['categoria'] ?>" data-toggle="modal" data-target="#editCategoriaModal">Editar</button>
                        <!-- Botão para Excluir -->
                        <button class="btn btn-danger btn-sm" data-id="<?= $categoria['idcategoria'] ?>" data-toggle="modal" data-target="#confirmDeleteModal">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<!-- Modal de Edição -->
<div class="modal fade" id="editCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="editCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoriaModalLabel">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="idcategoria" id="idCategoriaToEdit" value="">
                    <div class="form-group">
                        <label for="nome_categoria">Nome da Categoria</label>
                        <input type="text" class="form-control" name="nome_categoria" id="nomeCategoriaToEdit" value="">
                        <label for="imagem" class="form-label">Imagem da Categoria</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta categoria? Essa ação é permanente!
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    <input type="hidden" name="idcategoria" id="idcategoriaToDelete" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Inclua o jQuery e Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    // Função para ativar o modal de edição com os dados da categoria
    $('#editCategoriaModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var idcategoria = button.data('id');
        var nomeCategoria = button.data('nome');
        var modal = $(this);
        modal.find('#idCategoriaToEdit').val(idcategoria);
        modal.find('#nomeCategoriaToEdit').val(nomeCategoria);
    });

    // Adiciona blur no background quando o modal de exclusão ou edição é aberto
    $('#editCategoriaModal, #confirmDeleteModal').on('show.bs.modal', function () {
        $('main').addClass('blur-background');
    });

    // Remove blur quando o modal é fechado
    $('#editCategoriaModal, #confirmDeleteModal').on('hidden.bs.modal', function () {
        $('main').removeClass('blur-background');
    });

    // Função para ativar o modal de exclusão com o ID da categoria
    $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var idcategoria = button.data('id');
        var modal = $(this);
        modal.find('#idcategoriaToDelete').val(idcategoria);
    });
</script>

<?php
include "../layout/rodape.php";
?>
