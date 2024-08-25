<tr style="height: 100px">
    <td>
    <?php
if (!empty($produto['imagem'])) {

    $encodedImage = base64_encode($produto['imagem']);
    echo '<img src="data:image/jpeg;base64,' . $encodedImage . '" alt="' . $produto['nome'] . '" style="width: 100px; height: auto;">';
} else {
    echo '<span>Sem Imagem</span>';
}
?>

    </td>
    <td><?php echo $produto['idproduto']; ?></td>
    <td><?php echo $produto['nome']; ?></td>
    <td><?php echo number_format($produto['preco_avista'], 2, ',', '.'); ?></td>
    <td><?php echo number_format($produto['preco_parcelado'], 2, ',', '.'); ?></td>
    <td><?php echo $produto['visitas'] ?></td>

    <td>
        <a href="form_edita_produto.php?idproduto=<?php echo $produto['idproduto']; ?>" class="btn btn-primary btn-sm">Editar</a>
        <a href="?idproduto=<?php echo $produto['idproduto']; ?>" onclick="return confirm('Tem certeza que deseja remover este produto?');" class="btn btn-danger btn-sm">Excluir</a>
    </td>
</tr>
