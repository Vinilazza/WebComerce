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


  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <a href="../../index.php">
          <img src="/img/logo5.png" width="100px" alt="">
        </a>
      </div>

      <ul class="list-unstyled components p-2">
        <li class="p-1">
          <a href="/admin/index.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Inicio</a>
        </li>
        <li class="p-1">
          <a href="#produtosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <img src="<?php echo $public; ?>/img/diamond.svg" alt="Ícone produto" width="20px">
            Produtos
          </a>
          <ul class="collapse list-unstyled p-2 " id="produtosSubmenu">
            <li class="mb-2">
              <a href="<?php echo $produtos; ?>/form_cadastro_produto.php">Cadastrar produtos</a>
            </li>
            <li>
              <a href="<?php echo $produtos; ?>/form_lista_produtos.php">Listar produtos</a>
            </li>
          </ul>
        </li>

        <li class="p-1">
          <a href="#produtosSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="20">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            Usuarios
          </a>
          <ul class="collapse list-unstyled p-2" id="produtosSubmenu2">
            <li class="mb-2">
              <a href="<?php echo $usuarios; ?>/form_cadastro_usuario.php">Cadastrar usuario</a>
            </li>
            <li>
              <a href="<?php echo $usuarios; ?>/form_lista_usuarios.php">Listar usuarios</a>
            </li>
          </ul>
        </li>
        <li class="p-1">
          <a href="#produtosSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" width="20" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Clientes
          </a>
          <ul class="collapse list-unstyled p-2" id="produtosSubmenu3">
            <li class="mb-2">
              <a href="<?php echo $clientes; ?>/form_lista_clientes.php">Listar clientes</a>
            </li>
          </ul>
        </li>
      </ul>


      <ul>
        <li>
          <a href="<?php echo $login; ?>/logout.php" class="mt-1 me-1">Sair</a>
        </li>
      </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">