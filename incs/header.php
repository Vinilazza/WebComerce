<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
$cart_count = count($_SESSION['carrinho']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="icon" href="/img/icon.png" type="image/png">
    <title>VLTECH | Os melhores produtos e serviços de informatica</title>
</head>

<body class="bg-opacity-75">
    <header class=" text-dark">
        <div class="container d-flex justify-content-between  py-2">

            <div class="d-flex-justify-content-start">
                <div class="letra col-2 d-flex">
                    <a href="/index.php"> <img src="img/icon.png" class="logo rounded me-2" alt="logotipo do site"></a>
                    <div class="d-flex align-items-center">
                        <a href="/index.php" class="text-decoration-none">
                            <h4 class=" lg2">
                                <span class="vltech">VL</span><span class="tech">TECH</span>
                                <span class="informatica">INFORMATICA</span>
                            </h4>
                        </a>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-center">
                <div class="d-flex align-items-center">
                    <form action="search.php" method="GET">

                        <div class="form shadow-sm">
                            <input type="text" class="form-control form-input-sm" style="width: 450px;" placeholder="Buscar produtos, marcas e muito mais...">
                            <span class="left-pan"><button class="btn btn-transparent btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </button>
                            </span>
                        </div>

                    </form>
                </div>
            </div>



            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center">
                    <a href="carrinho.php" class="text-decoration-none text-dark position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <?php if ($cart_count > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $cart_count; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <a href="login.php" class="mx-3 text-decoration-none text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                    </a>
                </div>
            </div>




        </div>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="img/diamante.png" width="20px" alt=""> <b> Jóias</b>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Prata</a></li>
                                <li><a class="dropdown-item" href="#">Ouro</a></li>
                                <li><a class="dropdown-item" href="#">Ouro Branco</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#"><img src="img/anel.png" width="25px" alt=""> <b>Semijóias</b> </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#"><img src="img/livro.jpg" width="30px" alt=""> <b>Revenda</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>