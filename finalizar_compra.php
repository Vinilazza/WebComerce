<?php
    include "incs/header.php";
    require_once "admin/src/CompraDAO.php";

    $compraDAO = new CompraDAO();
    $compraDAO->registrarCompra($_SESSION);

?>

<div class="container w-75 m-5">
    <h3>Sua compra foi realizada com sucesso!</h3>
</div>

<?php
    include "incs/footer.php"
?>