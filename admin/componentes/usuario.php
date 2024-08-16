<tr>                    
    <td><?php echo $usuario['idusuarios'] ?></td>
    <td><?php echo $usuario['login'] ?></td>
    <td>
        <a href="form_edita_produto.php?idproduto='<?=$usuario['idusuarios']?>'" class="btn btn-success btn-sm">Editar</a>
        <a href="../delete.php?idusuarios=<?= $usuario['idusuarios'] ?>" class="btn btn-danger btn-sm">Remover</a>
    </td>
</tr>