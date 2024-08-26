<?php
session_start();


require_once "admin/src/CategoriaDAO.php";

$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->consultarCategorias();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
$cart_count = count($_SESSION['carrinho']);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/hover.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="icon" href="/img/icon.png" type="image/png">
    <title>VLTECH | Os melhores produtos e serviços de informatica</title>
</head>

<body class="bg-opacity-75">
    <!-- NAV - Busca, Logo e Carrinho -->
    <!-- NAV - Busca, Logo e Carrinho -->
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container d-flex">
            <!-- Logo -->
            <div class="letra col-2 d-flex">
                <a href="/index.php" class="hrv">
                    <img src="img/icon.png" class="logo rounded me-2" alt="logotipo do site">
                </a>
                <div class="d-flex align-items-center">
                    <a href="/index.php" class="hrv text-decoration-none">
                        <h4 class="lg2">
                            <span class="vltech">VL</span><span class="tech">TECH</span>
                            <span class="informatica">INFORMATICA</span>
                        </h4>
                    </a>
                </div>
            </div>

            <!-- Formulário de Busca - visível apenas em telas maiores -->
            <div class="d-flex justify-content-center col-4 d-none d-lg-flex">
                <div class="d-flex align-items-center">
                    <form action="search.php" method="GET">
                        <div class="form shadow-sm">
                            <input type="text" name="query" class="form-control form-input-sm search-bar" placeholder="Buscar produtos, marcas e muito mais...">
                            <span class="left-pan">
                                <button class="btn btn-transparent btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Carrinho - visível apenas em telas maiores -->
            <div class="d-flex justify-content-end d-none d-lg-flex">
                <div class="d-flex align-items-center">
                    <a href="carrinho.php" class="hrv text-decoration-none text-dark position-relative me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <?php if ($cart_count > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $cart_count; ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <?php if (isset($_SESSION['user_id']) || isset($_SESSION['user_email'])): ?>
                        <div class="dropdown">
                            <a href="#" class="btn-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (!empty($_SESSION['user_picture'])): ?>
                                    <!-- Exibir a imagem a partir de uma URL -->
                                    <img src="<?= htmlspecialchars($_SESSION['user_picture']) ?>" style="border-radius: 50px" width="30" alt="Foto de Perfil">
                                <?php elseif (!empty($_SESSION['user_picture_blob'])): ?>
                                    <!-- Exibir a imagem a partir de um blob em base64 -->
                                    <img src="data:image/jpeg;base64,<?= base64_encode($_SESSION['user_picture_blob']) ?>" style="border-radius: 50px" width="30" alt="Foto de Perfil">
                                <?php else: ?>
                                    <!-- Exibir uma imagem padrão caso nenhuma das anteriores esteja definida -->
                                    <img src="/img/default-profile.png" style="border-radius: 50px" width="30" alt="Foto de Perfil Padrão">
                                <?php endif; ?>
                            </a>
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header dropdown-menu-end text-wrap">Seja bem vindo, <?= htmlspecialchars($_SESSION['user_name']) ?></li>
                                <li><a href="#" class="dropdown-item">Meu perfil</a></li>
                                <li><a href="#" class="dropdown-item">Configurações</a></li>
                                <li class="divider"></li>
                                <li><a href="/logout.php" class="dropdown-item">Sair</a></li>
                            </ul>
                        </div>

                    <?php else: ?>
                        <a href="login.php" class="hrv mx-3 text-decoration-none text-dark">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </a>
                    <?php endif; ?>


                </div>
            </div>

            <!-- Toggler para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- HEADER - Categorias -->
    <!-- HEADER - Categorias -->
    <header class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="collapse navbar-collapse" id="navbarHeader">
            <div class="container d-flex align-items-center" style="height: 35px;">
                <li class="nav-item d-none d-lg-block dropdown me-2 p-2" style="box-shadow: 0 0 1px rgba(0, 0, 0, 0);">
                    <a class="text-decoration-none dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu aclass" aria-labelledby="navbarDropdownMenuLink2">
                        <?php
                        if (sizeof($categorias) > 0) {
                            foreach ($categorias as $categoria) {
                                $id = $categoria['idcategoria'];
                                $nome = $categoria['categoria'];
                                echo "<li><a class='dropdown-item' href='index.php?categoria=$id' id='$id'>$nome</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item p-2 d-none d-lg-block me-2 hvr-underline-from-left d-flex align-items-center">
                    <a href="#" class="text-decoration-none text-dark ">Ofertas</a>
                </li>
                <li class="nav-item d-none d-lg-block  p-2 me-2 hvr-underline-from-left d-flex align-items-center">
                    <a href="#" class="text-decoration-none text-dark">Computadores</a>
                </li>
                <li class="nav-item d-none d-lg-block p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <a href="#" class="text-decoration-none text-dark">Perifericos</a>
                </li>
                <li class="nav-item d-none d-lg-block p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <a href="#" class="text-decoration-none text-dark">Rede</a>
                </li>
                <!-- Categorias -->

                <li class="nav-item p-2 d-none d-lg-block me-2 hvr-underline-from-left d-flex  align-items-center">
                    <a href="#" class="text-decoration-none text-decoration-none text-dark">Suporte Tecnico</a>
                </li>
            </div>
            <ul class="navbar-nav">
                <!-- Remova a barra de busca daqui se quiser apenas no topo -->

                <li class="nav-item d-lg-none me-2 d-flex align-items-center ">
                    <div class="justify-content-center col-4 w-100">
                        <div class="d-flex align-items-center">
                            <form action="search.php" method="GET" class="formSearch">
                                <div class="form shadow-sm">
                                    <input type="text" class="form-control form-input-sm search-bar" placeholder="Buscar produtos, marcas e muito mais...">
                                    <span class="left-pan">
                                        <button class="btn btn-transparent btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex align-items-center">
                    <a href="#" class="text-decoration-none text-dark ">Ofertas</a>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex align-items-center">
                    <a href="#" class="text-decoration-none text-dark">Computadores</a>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <a href="#" class="text-decoration-none text-dark">Perifericos</a>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <a href="#" class="text-decoration-none text-dark">Rede</a>
                </li>
                <!-- Categorias -->
                <li class="nav-item dropdown d-lg-none p-2 me-2">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu aclass" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                        if (sizeof($categorias) > 0) {
                            foreach ($categorias as $categoria) {
                                $id = $categoria['idcategoria'];
                                $nome = $categoria['categoria'];
                                echo "<li><a class='dropdown-item' href='index.php?categoria=$id' id='$id'>$nome</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <a href="#" class="nav-link text-decoration-none text-dark">Suporte Tecnico</a>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart me-2" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    <a href="/carrinho.php" class="nav-link text-decoration-none text-dark">Carrinho (<?php echo $cart_count; ?>)</a>
                </li>
                <li class="nav-item d-lg-none p-2 me-2 hvr-underline-from-left d-flex  align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill me-2" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                    <a href="login.php" class="nav-link text-dark">Login</a>
                </li>


            </ul>

        </div>
    </header>