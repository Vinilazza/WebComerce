<?php
    include "../layout/topo.php";
?>

<form action="cadastro_usuario.php" method="POST" class="container w-75 border rounded bg-secondary bg-opacity-50 needs-validation">
<h3 class="text-center mb-5 mt-0 needs-validation">Cadastro de Usuário</h3>

<?php
    if (isset($_GET['msg'])):
?>
    <div class="alert alert-danger" role="alert">
        <?=$_GET['msg']?>
    </div>
<?php
    endif;
?>

<div class="mb-3">
    <label for="loginId" class="form-label">Login</label>
    <input type="next" name="login" class="form-control" id="loginId"
    required>
    <div class="invalid-feedback">
       Usuário inválido. (nome.sobrenome)
    </div>
</div>

<div class="mb-3">
    <label for="senhaId" class="form-label">Senha</label>
    <input type="password" name="senha" class="form-control" id="senhaId"
    required>
</div>

<div class="mb-3">
    <label for="senha2Id" class="form-label">Confirmação de senha</label>
    <input type="password" name="senha2" class="form-control" id="senha2Id"
    required>
</div>

<div class="mb-3" >
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</div>

</form>

<?php
    include "../layout/rodape.php";
?>