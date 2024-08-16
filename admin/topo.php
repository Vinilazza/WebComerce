<?php
    require_once 'src/ConexaoBD.php';
?>
<?php
    include "validar_sessao.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MA Admin</title>

    <!-- Bootstrap CSS CDN -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">



    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilo_menu.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="index.php">
                <h3>MA - Admin</h3>
                <strong>Admin</strong>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#produtosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <img src="img/diamond.svg" alt="Ícone produto" width="20px">
                        Produtos
                    </a>
                    <ul class="collapse list-unstyled" id="produtosSubmenu">
                        <li>
                            <a href="form_cadastro_produto.php">Cadastrar produtos</a>
                        </li>
                        <li>
                            <a href="form_lista_produtos.php">Listar produtos</a>
                        </li>
                    </ul>
                </li>
            
                <li class="active">
                    <a href="#produtosSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <img src="img/diamond.svg" alt="Ícone produto" width="20px">
                        Produtos
                    </a>
                    <ul class="collapse list-unstyled" id="produtosSubmenu2">
                        <li>
                            <a href="form_cadastro_usuarios.php">Cadastrar produtos</a>
                        </li>
                        <li>
                            <a href="form_lista_usuarios.php">Listar produtos</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul>
                <li>
                    <a href="admin/logout.php" class="mt-1 me-1">Sair</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
