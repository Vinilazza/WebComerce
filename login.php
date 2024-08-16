<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">

    <title>Login</title>
</head>

<body>

    <div class="logo">
        <a href="paginainicial.php">
                <img src="img/logo.png" width="90" height="80" alt="logo" id="imglogo" />
        </a>
        
    </div>

    <form>
        <h1>Login</h1>

        <div class="inputs-div">
            <input class="login" type="text" placeholder="Usuário" id="usuario">

            <input class="senha" type="password" placeholder="Senha" id="password">
        </div>


        <div class="hyperlinks">
            <a href="#">Esqueceu a senha?</a>
            <a href="cadastro.php">Nâo possui cadastro?</a>
        </div>


        <button>Entrar</button>
    </form>
</body>

</html>