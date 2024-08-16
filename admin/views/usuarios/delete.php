<?php

require_once('../../src/UsuarioDAO.php');
require_once('../../src/ConexaoBD.php');
$usuarioDAO = new UsuarioDAO();
$usuarioDAO->deletar($_GET['idusuarios']);

header("Location: form_lista_usuarios.php");