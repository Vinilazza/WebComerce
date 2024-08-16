<?php
    session_start();
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
    <title>Página Inicial</title>
</head>

<body class="bg-opacity-75">
    <header class=" text-dark">
        <div class="container d-flex justify-content-between  py-2">

            <div class="letra"> 
             <a href="../paginainicial.php"> <img src="img/logo.png" class="logo rounded me-2" alt="logotipo do site"></a>
                <p class="d-inline-flex fs-7 text-light fw-bold">Jóias e semijóias</p>
            </div>

            <div class="d-inline-flex">
                <nav class="navbar navbar-light ">
                    <div class="container-fluid">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-light" type="submit"> <img src="img/search.svg" alt=""></button>
                        </form>

                        <a href="login.php" class="mx-3"><img src="img/usua.png" alt="" width="20px"></a>
                        <a href="carrinho.php"><img src="img/car.png" alt="" width="20px"></a>            
                    </div>
                </nav> 
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