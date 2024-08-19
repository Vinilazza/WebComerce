<?php
// Define the base URL for the admin panel
define('BASE_URL', '/admin');

// Paths for various views
$public = BASE_URL . '/public';

$produtos = BASE_URL . '/views/produtos';
$usuarios = BASE_URL . '/views/usuarios';
$login = BASE_URL . '/views/login';
$clientes = BASE_URL . '/views/clientes';

// Include necessary files
require_once __DIR__ . '/../../src/ConexaoBD.php';
include __DIR__ . '/../../views/login/validar_sessao.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>VLTECH | Administração</title>

    <!-- Bootstrap CSS CDN -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="icon" href="/img/icon.png" type="image/png">



    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo $public; ?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo $public; ?>/css/estilo_menu.css">
    <link rel="stylesheet" href="<?php echo $public; ?>/css/admin.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-md-block bg-light sidebar">
        <div class="flex-shrink-0 p-3" style="width: 280px;">

        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div>
                <!-- Your page content here -->
                <!-- Page Content -->
            </div>
        </main>
    </div>
</div>

    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
      <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-5 fw-semibold">Collapsible</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
          <a href="/index.php">Inicio</a>
        </button>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Produtos
        </button>
        <div class="collapse" id="dashboard-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="<?php echo $produtos; ?>/form_cadastro_produto.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Cadastrar produtos</a></li>
            <li><a href="<?php echo $produtos; ?>/form_lista_produtos.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Listar produtos</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true">
          Usuarios
        </button>
        <div class="collapse show" id="orders-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="<?php echo $usuarios; ?>/form_cadastro_usuario.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Cadastrar usuario</a></li>
            <li><a href="<?php echo $usuarios; ?>/form_lista_usuarios.php"  class="link-body-emphasis d-inline-flex text-decoration-none rounded">Lista usuario</a></li>
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Clientes
        </button>
        <div class="collapse" id="account-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="<?php echo $clientes; ?>/form_lista_clientes.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Listar clientes</a></li>   
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          <a href="<?php echo $login; ?>/logout.php">Sair</a>
        </button>
        
      </li>
    </ul>
  </div>


        <!-- Page Content  -->
