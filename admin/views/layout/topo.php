<?php
// Define the base URL for the admin panel
define('BASE_URL', '/admin');

// Paths for various views
$public = BASE_URL . '/public';

$produtos = BASE_URL . '/views/produtos';
$usuarios = BASE_URL . '/views/usuarios';
$login = BASE_URL . '/views/login';
$clientes = BASE_URL . '/views/clientes';
$categoria = BASE_URL . '/views/categorias';
$global = BASE_URL . '/views/global';
$admin = BASE_URL;
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
        <a href="<?=$admin?>/index.php">
          <img src="/img/logo5.png" width="100px" alt="">
        </a>
      </div>

      <ul class="list-unstyled components p-2">
        <li class="p-1">
          <a href="<?=$admin?>/index.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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
        <li class="p-1">
          <a href="#produtosSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="20" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
            </svg>

            Categorias
          </a>
          <ul class="collapse list-unstyled p-2" id="produtosSubmenu4">
            <li class="mb-2">
              <a href="<?php echo $categoria; ?>/cadastrar_categoria.php">Cadastrar categoria</a>
            </li>
            <li>
              <a href="<?php echo $categoria; ?>/listar_categorias.php">Listar categoria</a>
            </li>
          </ul>
        </li>
        <li class="p-1">
          <a href="#produtosSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20"viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
</svg>


            Parametros Globais
          </a>
          <ul class="collapse list-unstyled p-2" id="produtosSubmenu5">
            <li class="mb-2">
              <a href="<?php echo $global; ?>/margem/cadastrar_margem.php">Cadastrar margem</a>
            </li>

            <li class="mb-2">
              <a href="<?php echo $global; ?>/margem/listar_margens.php">Listar margem</a>
            </li>
            <li class="">
              <a href="<?php echo $global; ?>/banners/banner.php">Banners</a>
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