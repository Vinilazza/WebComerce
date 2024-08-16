<?php

    include "../layout/topo.php";    
    require_once("../../src/ClienteDAO.php");
    
    
    if (isset($_GET['mensagem']))
        $mensagem = $_GET['mensagem'];
    
    $clienteDAO = new ClienteDAO();

    if(isset($_GET['chave'])){
        $clientes = $clienteDAO->consultarPorChave($_GET['chave']);
    }else
        $clientes = $clienteDAO->consultarClientes();

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
    <form action="form_lista_clientes.php" class="container w-50 my-0 borde roundend p-3 ">
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
            <th>Nome</th>
            <th>Email</th>
            <th>Endereco</th>
            <th></th>
        </tr>
                
        <?php
        if(sizeof($clientes) > 0){
            foreach($clientes as $cliente){
                include("../../componentes/clientes.php");
            }
        }
        ?>

    </table>    


<?php
    include "../layout/rodape.php";
?>