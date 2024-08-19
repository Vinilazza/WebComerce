<tr>                    
    <td><?php echo $produto['idproduto'] ?></td>
    <td><?php echo $produto['nome'] ?></td>
    <td>R$<?php echo round($produto['preco'], 2) ?></td>
    <td>
        <a href="form_edita_produto.php?idproduto='<?=$produto['idproduto']?>'" class="btn btn-success btn-sm">Editar</a>
        <a href="/admin/views/produtos/deletar.php?idproduto=<?= $produto['idproduto'] ?>" class="btn btn-danger btn-sm">Remover</a>
    </td>
</tr>