<?php
    include "../layout/topo.php";    
    require_once("../../src/ClienteLogDAO.php");
    
    

    
    $ClienteDAO = new ClienteLogDAO();

    $cliente = $ClienteDAO->visitasProdutos();
?>  





    <div class="d-flex">
    <form action="" class="container w-50 my-0 borde roundend p-3 ">
    </div>

    <table>
        <tr>            
            <th>IdCliente</th>
            <th>Nome Cliente</th>
            <th>Email</th>
            <th>IdProduto</th>
            <th>Nome Produto</th>
        </tr>
                
        <?php
        if(sizeof($cliente) > 0){
            foreach($cliente as $c){
                include("../../componentes/visitas.php");
            }
        }  else {?>
            <tr>
                <td>Não foi encontrado produtos</td>
            </tr>
        <?php
        }
        ?>
        

    </table>    


<?php
    include "../layout/rodape.php";
?>