<?php
    include "topo.php";
?>

<?php
    if (isset($_GET['msg'])):
?>
    <div class="alert alert-success" role="alert">
        <?=$_GET['msg']?>
    </div>
<?php
    endif;
?>
        <!-- CONTEÚDO -->
            

            <h2>Área administrativa</h2>
            <p>Essa é a área administrativa da MA. Nela você pode fazer a gestão de cadastro dos produtos.</p>

            <div class="line"></div>            
                

        <!-- FIM CONTEÚDO -->

<?php
    include "rodape.php";
?>
