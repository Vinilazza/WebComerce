<?php
    include "views/layout/topo.php";
    include "src/ProdutoDAO.php";
    include "src/ClienteDAO.php";

    $produtoDAO =new ProdutoDAO();
    $clienteDAO =new ClienteDAO();
    $produtos = $produtoDAO->contarProdutos();
    $clientes = $produtoDAO->contarClientes();
    $visitas = $clienteDAO->contarVisitas()

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
            
        <div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $produtos ?></h3>
                    <p>Produtos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="/admin/views/produtos/form_lista_produtos.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Futuro</h3>
                    <p>Vendas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo $clientes ?></h3>
                    <p>Clientes registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="/admin/views/clientes/form_lista_clientes.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo $visitas ?></h3>
                    <p>Visitas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="/admin/views/clientes/form_lista_clientes.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Gráficos e outras informações -->
    <div class="row">
        <div class="col-lg-7">
            <!-- Sales Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales</h3>
                </div>
                <div class="card-body">
                    <div id="sales-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Visitors Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Visitors</h3>
                </div>
                <div class="card-body">
                    <div id="visitors-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Chart.js -->
<?php
// Exemplo de consulta para obter dados de vendas
$salesData = [40, 50, 40, 60, 70, 80, 90]; // Simulação de dados, mas normalmente você faria uma consulta ao banco de dados

?>
<script>
    var salesData = <?= json_encode($salesData) ?>;
    var ctx = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Sales',
                data: salesData,
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 2,
                fill: true,
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>



<?php
    include "views/layout/rodape.php";
?>
