<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>Cadastro</title>
</head>

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
    <body class="bg-opacity-25">
        <main class="d-flex justify-content-start align-items-center">
            <div class="mt-5 container w-75 bg-light border border-dark">
                <h1 class="mt-3 text-center">Cadastro</h1>
                <form class="m-3 row g-3">
                    <div class="col-md-6">
                        <label for="nomeId" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeId">
                    </div>

                    <div class="col-md-6">
                        <label for="sobrenomeId" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenomeId">
                    </div>

                    <div class="col-md-3">
                        <label for="dataId" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" id="dataId" placeholder="00/00/00000">
                    </div>

                    <div class="col-md-3">
                        <label for="cpfId" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpfId" placeholder="000.000.000-00">
                    </div>

                    <div class="col-md-3">
                        <label for="celularId" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celularId" placeholder="(00) 0000-0000">
                    </div>


                    <div class="col-md-3">
                        <label for="estadoId" class="form-label">Estado</label>
                        <select id="estadoId" class="form-select">
                            <option class="fw-bold">Selecione...</option>
                            <option> Acre</option>
                            <option>Alagoas</option>
                            <option>Amapá</option>
                            <option>Bahia</option>
                            <option>Ceará</option>
                            <option>Distrito Federal</option>
                            <option>Espírito Santo</option>
                            <option>Goiás</option>
                            <option>Maranhão</option>
                            <option>Mato Grosso</option>
                            <option>Mato Grosso do Sul</option>
                            <option>Minas Gerais</option>
                            <option>Pará</option>
                            <option>Paraíba</option>
                            <option>Paraná</option>
                            <option>Pernambuco</option>
                            <option>Piauí</option>
                            <option>Rio de Janeiro</option>
                            <option>Rio Grande do Norte</option>
                            <option>Rio Grande do Sul</option>
                            <option>Rondônia</option>
                            <option>Roraima</option>
                            <option>Santa Catarina</option>
                            <option>São Paulo</option>
                            <option>Sergipe</option>
                            <option>Tocantins</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="cidadeId" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidadeId">
                    </div>

                    <div class="col-md-4">
                        <label for="cepId" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cepId" placeholder="00000-000">
                    </div>

                    <div class="col-md-4">
                        <label for="bairrod" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairroId">
                    </div>

                    <div class="col-md-6">
                        <label for="emailId" class="form-label">Email</label>
                        <input type="Email" class="form-control" id="emailId" placeholder="nome@dominio.com">
                    </div>

                    <div class="col-md-6">
                        <label for="senhaId" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senhaId">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="termosId">
                            <label class="form-check-label" for="termosId">
                                <p>Concordo com os termos de política de privacidade</p>
                            </label>
                        </div>
                    </div>

                    <div>
                        <input class="submit" type="submit" value="Cadastrar" class="botao w-20 link-dark fw-bold">
                    </div> 
                </form>
            </div>
        </main>

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

    </body>
</html>