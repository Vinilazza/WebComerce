<?php
include "../../layout/topo.php";
require_once "../../../src/BannerDAO.php";

$bannerDAO = new BannerDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        // Adicionar novo banner
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $titulo = $_POST['titulo'];
        $link = $_POST['link'];
        $ordem = $_POST['ordem'];
        $bannerDAO->adicionarBanner($imagem, $titulo, $link, $ordem);
    } elseif (isset($_POST['atualizar'])) {
        // Atualizar banner existente
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $link = $_POST['link'];
        $ordem = $_POST['ordem'];
        $ativo = isset($_POST['ativo']) ? 1 : 0;
        $bannerDAO->atualizarBanner($id, $titulo, $link, $ordem, $ativo);
    } elseif (isset($_POST['excluir'])) {
        // Excluir banner
        $id = $_POST['id'];
        $bannerDAO->excluirBanner($id);
    }
}

$banners = $bannerDAO->listarBanners();
?>

<h2>Gerenciar Banners</h2>

<!-- Formulário para adicionar novo banner -->
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label>Imagem</label>
        <input type="file" name="imagem" required>
    </div>
    <div>
        <label>Título</label>
        <input type="text" name="titulo" required>
    </div>
    <div>
        <label>Link</label>
        <input type="text" name="link">
    </div>
    <div>
        <label>Ordem</label>
        <input type="number" name="ordem" value="0">
    </div>
    <div>
        <button type="submit" name="adicionar">Adicionar Banner</button>
    </div>
</form>

<!-- Listagem de banners existentes -->
<table>
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Título</th>
            <th>Link</th>
            <th>Ordem</th>
            <th>Ativo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($banners as $banner): ?>
        <tr>
            <td><img src="data:image/jpeg;base64,<?= base64_encode($banner['imagem']) ?>" style="width: 100px;"></td>
            <td><?= htmlspecialchars($banner['titulo']) ?></td>
            <td><?= htmlspecialchars($banner['link']) ?></td>
            <td><?= $banner['ordem'] ?></td>
            <td><?= $banner['ativo'] ? 'Sim' : 'Não' ?></td>
            <td>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $banner['id'] ?>">
                    <button type="submit" name="excluir">Excluir</button>
                </form>
                <button onclick="document.getElementById('edit-<?= $banner['id'] ?>').style.display='block'">Editar</button>

                <!-- Formulário de edição -->
                <div id="edit-<?= $banner['id'] ?>" style="display:none;">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $banner['id'] ?>">
                        <input type="text" name="titulo" value="<?= htmlspecialchars($banner['titulo']) ?>" required>
                        <input type="text" name="link" value="<?= htmlspecialchars($banner['link']) ?>">
                        <input type="number" name="ordem" value="<?= $banner['ordem'] ?>">
                        <input type="checkbox" name="ativo" <?= $banner['ativo'] ? 'checked' : '' ?>> Ativo
                        <button type="submit" name="atualizar">Salvar</button>
                        <button type="button" onclick="document.getElementById('edit-<?= $banner['id'] ?>').style.display='none'">Cancelar</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../../layout/rodape.php"; ?>
