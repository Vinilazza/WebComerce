<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<form action="efetuar_login.php" method="POST" class="container w-50 border-2 rounded border-secondary bg-secondary bg-opacity-50 mt-5 px-3 py-2">
<h4 class="text-center mb-6 mt-2 needs-validation">MA - Área Administrativa</h4>

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
       Usuário inválido.
    </div>
</div>

<div class="mb-3">
    <label for="senhaId" class="form-label">Senha</label>
    <input type="password" name="senha" class="form-control" id="senhaId"
    required>
</div>


<div class="mb-3" >
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</div>

</form>
</body>
</html>