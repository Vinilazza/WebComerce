<?php
ob_start();

include "../../layout/topo.php";
require_once('../../../src/ValorProdutoDAO.php');

$valorProdutoDAO = new ValorProdutoDAO();
$margens = $valorProdutoDAO->listarMargens();

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $valorProdutoDAO->excluirMargem($id);
    header("Location: listar_margens.php");
    exit;
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $margem = $_POST['margem'];
    $valorProdutoDAO->atualizarMargem($id, $nome, $margem);

    header("Location: listar_margens.php");

    exit;
}

ob_end_flush();

?>
<h2>Lista de Margens</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Percentual de Margem (%)</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($margens as $margem): ?>
            <tr>
                <td><?php echo $margem['id']; ?></td>
                <td><?php echo $margem['nome']; ?></td>
                <td><?php echo $margem['margem']; ?>%</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $margem['id']; ?>">Editar</button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo $margem['id']; ?>">Excluir</button>
                </td>
            </tr>

            <!-- Modal Editar -->
            <div class="modal fade" id="editModal-<?php echo $margem['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel-<?php echo $margem['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $margem['id']; ?>">Editar Margem</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $margem['id']; ?>">
                                <div class="mb-3">
                                    <label for="nome-<?php echo $margem['id']; ?>" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome-<?php echo $margem['id']; ?>" name="nome" value="<?php echo $margem['nome']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="margem-<?php echo $margem['id']; ?>" class="form-label">Percentual de Margem (%)</label>
                                    <input type="number" class="form-control" id="margem-<?php echo $margem['id']; ?>" name="margem" value="<?php echo $margem['margem']; ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" name="edit">Salvar mudanças</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Excluir -->
            <div class="modal fade" id="deleteModal-<?php echo $margem['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel-<?php echo $margem['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-<?php echo $margem['id']; ?>">Excluir Margem</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $margem['id']; ?>">
                                <p>Tem certeza que deseja excluir a margem <strong><?php echo $margem['nome']; ?></strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" name="delete">Excluir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
include "../../layout/rodape.php";
?>
