<?php
    include "topo.php";    
    require_once("src/usuarioDAO.php");
    
    
    if (isset($_GET['mensagem']))
        $mensagem = $_GET['mensagem'];
    
    $usuarioDAO = new usuarioDAO();
    if(isset($_GET['idusuario'])){
        $ProdutoDAO->remover($_GET['idusuario']);
        $mensagem = "Usuario removido com sucesso";
    }

    if(isset($_GET['chave'])){
        $usuarios = $usuarioDAO->consultarPorChave($_GET['chave']);
    }else
        $usuarios = $usuarioDAO->consultarUsuarios();

    if (isset($mensagem)){
?>  
    <div class="alert alert-primary mb-5" role="alert">
        <?=$mensagem?>
    </div>

<?php
    }else{
?>
        <div class="alert mb-5" role="alert">
        </div>
<?php
}

?>

    <div class="d-flex">
    <form action="form_lista_usuarios.php" class="container w-50 my-0 borde roundend p-3 ">
        <div class="mb-2">
            <label class="form-label">Buscar por Nome</label>
            <input type="text" name="chave" class="form-control">
        </div>

        <div class="mb-2">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </div>
    </div>

    <table>
        <tr>            
            <th>ID</th>
            <th>Nome do produto</th>
            <th></th>
        </tr>
                
        <?php
        if(sizeof($usuarios) > 0){
            foreach($usuarios as $usuario){
                include("componentes/usuario.php");
            }
        }
        ?>

    </table>    


<?php
    include "rodape.php";
?>