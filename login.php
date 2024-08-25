<?php
session_start();

// Incluir autoload do Composer
require_once 'vendor/autoload.php';
require_once "admin/src/ClienteDAO.php";
require_once "admin/src/ClienteLogDAO.php";

// Configurações da API do Google
$client = new Google_Client();
$client->setClientId('142057793318-kp5hvaj401ho2vn1bai0ipaqkk94edip.apps.googleusercontent.com'); // Substitua 'SEU_CLIENT_ID' pelo seu Client ID
$client->setClientSecret('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'); // Substitua 'SEU_CLIENT_SECRET' pelo seu Client Secret
$client->setRedirectUri('http://localhost:8000/login.php'); // Substitua com a URL do seu callback
$client->addScope('email');
$client->addScope('profile');

$ClienteLog = new ClienteLogDAO();

// Verifica se o código de autorização foi retornado do Google
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Obtendo informações do perfil do usuário
    $oauth2 = new Google\Service\Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    $clienteDAO = new ClienteDAO();
    $cliente = $clienteDAO->verificarUsuario($userInfo->id);

    if (!$cliente) {
        // Usuário não existe, cria um novo
        $id = $userInfo->id;
        $name = $userInfo->name;
        $email = $userInfo->email;
        $foto = $userInfo->picture;

        try {
            // Cria o novo usuário
            $clienteDAO->cadastrarUsuario($id, $name, $email, $foto);

            // Recupera o ID do novo cliente
            $cliente = $clienteDAO->verificarUsuario($userInfo->id);

            // Registra o log após a criação do usuário
            $ClienteLog->registrarLog($cliente['idcliente'], 'Usuario Criado');

            // Configura a sessão do usuário
            $_SESSION['idcliente'] = $cliente['idcliente'];
            $_SESSION['user_id'] = $userInfo->id;
            $_SESSION['user_name'] = $userInfo->name;
            $_SESSION['user_email'] = $userInfo->email;
            $_SESSION['user_picture'] = $userInfo->picture;

            $ClienteLog->registrarLog($cliente['idcliente'], 'Login efetuado');

            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    } else {
        // Usuário existe, apenas registra o login
        $ClienteLog->registrarLog($cliente['idcliente'], 'Login efetuado');
        $_SESSION['idcliente'] = $cliente['idcliente'];
        $_SESSION['user_id'] = $userInfo->id;
        $_SESSION['user_name'] = $userInfo->name;
        $_SESSION['user_email'] = $userInfo->email;
        $_SESSION['user_picture'] = $userInfo->picture;
        header('Location: index.php');
        exit;
    }
}

// Gera o URL de autenticação do Google
$loginUrl = $client->createAuthUrl();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login com Google</title>
</head>
<body>
    <h2>Login com Google</h2>
    <a href="<?= htmlspecialchars($loginUrl) ?>">Login com Google</a>
</body>
</html>
