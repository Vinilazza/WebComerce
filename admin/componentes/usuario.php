<?php
$basePath = '/admin/views/usuarios';
?>
<tr>                    
    <td><?php echo $usuario['idusuarios'] ?></td>
    <td><?php echo $usuario['login'] ?></td>
    <td>
        <a href="<?php echo $basePath; ?>/form_edit_pass.php?idproduto='<?=$usuario['idusuarios']?>'" class="btn btn-success btn-sm">Alterar Senha</a>
        <a href="<?php echo $basePath; ?>/delete.php?idusuarios=<?= $usuario['idusuarios'] ?>" class="btn btn-danger btn-sm">Remover</a>
    </td>
</tr>
