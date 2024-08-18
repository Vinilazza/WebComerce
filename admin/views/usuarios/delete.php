<?php

require_once('../../src/UsuarioDAO.php');
require_once('../../src/ConexaoBD.php');
$usuarioDAO = new UsuarioDAO();
$usuarioDAO->deletar($_GET['idadmin']);

header("Location: form_lista_usuarios.php");