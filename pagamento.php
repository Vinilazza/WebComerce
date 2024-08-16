<?php
  session_start();
  require_once "admin/src/ClienteDAO.php";

  $clienteDAO = new ClienteDAO();
  $cliente = $clienteDAO->consultarCliente("mariaclbressiani@gmail.com");
  $_SESSION['idcliente'] = $cliente['idcliente'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Pagamento</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pagamento.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
  <header class=" text-dark">
    <div class="container d-flex justify-content-between  py-2">

        <div class="letra">
            <a href="paginainicial.php"><img src="img/logo.png" class="logo rounded me-2" alt="logotipo do site"></a>
            <p class="d-inline-flex fs-7 text-light fw-bold">Jóias e semijóias</p>
        </div>

        <div class="d-inline-flex">
            <nav class="navbar navbar-light ">
                <div class="container-fluid">
                    <form class="d-flex">
                        <input class="form-control-light me-2" type="search" placeholder="Pesquisar" aria-label="Search">
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

  <main>
    <div class="container2 bg-light d-md-flex align-items-center"> 
      <div class="card box1 shadow-sm p-md-5 p-md-5 p-4"> 
        <div class="fw-bolder mb-4">
          <span class="fas fa-dollar-sign"></span>
          <span class="ps-1">R$ <?=number_format ($_SESSION['total'],2,",",".")?></span>
        </div> 

      <div class="d-flex flex-column"> 
        <div class="d-flex align-items-center justify-content-between text">
            <span class="">Taxa de frete</span> 
            <span class="fas fa-dollar-sign">
              <span class="ps-1">R$15,00</span>
            </span> 
        </div> 

        <div class="d-flex align-items-center justify-content-between text mb-4"> 
              <span>Total</span> 
              <span class="fas fa-dollar-sign">
                <span class="ps-1">R$ <?=number_format (($_SESSION['total']+15),2,",",".")?> </span>
              </span> 
        </div> 

        <div class="border-bottom mb-4"></div>            
        <div class="d-flex flex-column mb-5"> 
          <span class="far fa-calendar-alt text">
              <span class="ps-2">Próximo pagamento:</span>
          </span> 
          <span class="ps-3">22 de julho, 2022</span>
        </div>
         
        <div class="d-flex align-items-center justify-content-between text mt-5">
          <div class="d-flex flex-column text"> 
            <span>Dados do cliente:</span> 
            <p>Nome: <?=$cliente['nome']?></p>
            <p>Email: <?=$cliente['email']?></p>
          </div> 
      </div> 
    </div> 
  </div> 
                     
        <div class="card box2 shadow-sm">
          <div class="d-flex align-items-center justify-content-between p-md-5 p-4"> 
            <span class="h5 fw-bold m-0">Métodos de pagamento</span> 
            <span class="fas fa-bars"></span>
        </div> 
                    
        <ul class="nav nav-tabs mb-3 px-md-4 px-2"> 
          <li class="nav-item">
            <a class="nav-link px-2 active" aria-current="page" href="#">Cartão de crédito</a> 
          </li> 
          <li class="nav-item"> 
            <a class="nav-link px-2" href="#">Boleto</a> 
          </li> 
          <li class="nav-item ms-auto">
            <a class="nav-link px-2" href="#">+ Mais</a> 
          </li> </ul> 
        </br>
            
    <form action="finalizar_compra.php"> 
      <div class="row">
        <div class="col-12"> 
          <div class="d-flex flex-column px-md-5 px-4 mb-4"> 
            <span>Cartão de crédito</span> 
             <div class="inputWithIcon"> 
                <input class="form-control" type="text" value="0000 0000 0000 0000">
                <span class=""> 
                  <img class="master" src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png" alt="">
                </span> 
              </div> 
          </div> 
        </div>
     
    <div class="col-md-6"> 
      <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4"> 
        <span>Data de vencimento</span> 
                        
        <div class="inputWithIcon"> 
          <input type="text" class="form-control" value="00/00"> 
          <span class="fas fa-calendar-alt"></span> 
        </div>
      </div> 
    </div> 
    
    <div class="col-md-6"> 
      <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4">
         <span>Código CVV</span> 
          <div class="inputWithIcon"> <input type="password" class="form-control" value="123"> 
             <span class="fas fa-lock"></span>
          </div> 
      </div>
    </div> 
             
          <div class="col-12"> 
              <div class="d-flex flex-column px-md-5 px-4 mb-4"> 
               <span>Nome</span>
                <div class="inputWithIcon">
                  <input class="form-control text-uppercase" type="text" value=""> 
                    <span class="far fa-user"></span>
                </div>
             </div> 
            </div> 

          <div class="col-12 px-md-5 px-4 mt-3">
            <button type="submit" class="btn btn-primary w-100">
              Pagar 
            </button> 
          </div>
     
       </form>
     </div> 
    </div>
  </main>
</body>

    <footer class="bg-dark text-center text-white mt-5">
        <div class="container p-4 pb-0">
          <section class="mb-4">
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="bi bi-facebook"></i
            ></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="bi bi-twitter"></i
            ></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="bi bi-google"></i
            ></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="bi bi-instagram"></i
            ></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="bi bi-linkedin"></i
            ></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
              ><i class="bi bi-github"></i
            ></a>
          </section>
        </div>
        <div class="text-center p-4" style="background-color: rgb(10, 29, 56);">
          © 2022 Copyright
          <a class="text-white" href="https://mdbootstrap.com/"></a>
        </div>
      </footer>
    
    </html>