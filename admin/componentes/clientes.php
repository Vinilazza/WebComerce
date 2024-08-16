<tr>                    
    <td><?php echo $cliente['idcliente'] ?></td>
    <td><?php echo $cliente['nome'] ?></td>
    <td><?php echo $cliente['email'] ?></td>
    <td><?php echo $cliente['endereco'] ?></td>
    <td>
        <a href="form_edita_produto.php?idcliente='<?=$cliente['idcliente']?>'" class="btn btn-success btn-sm">Editar</a>
    </td>
</tr>