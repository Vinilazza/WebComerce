<?php
$basePath = '/admin/views/usuarios';
?>
<tr>                    
    <td><?php echo $usuario['idadmin'] ?></td>
    <td><?php echo $usuario['nome'] ?></td>
    <td><?php echo $usuario['email'] ?></td>
    <td><?php echo $usuario['created_at'] ?></td>

    <td>
        <a href="<?php echo $basePath; ?>/form_edit_pass.php?idadmin='<?=$usuario['idadmin']?>'" class="btn btn-success btn-sm">Alterar Senha</a>
        <a href="<?php echo $basePath; ?>/delete.php?idadmin=<?= $usuario['idadmin'] ?>" class="btn btn-danger btn-sm">Remover</a>
    </td>
</tr>
