<?php
include "views/layout/topo.php";
include "src/ProdutoDAO.php";
include "src/ClienteDAO.php";
include "src/ClienteLogDAO.php";

$produtoDAO = new ProdutoDAO();
$clienteDAO = new ClienteDAO();
$produtos = $produtoDAO->contarProdutos();
$clientes = $produtoDAO->contarClientes();
$visitas = $clienteDAO->contarVisitas();

$ClienteLog = new ClienteLogDAO();

$visitasProdutos = $ClienteLog->countProdutos();

$nomesProdutos = [];
$quantidadeVisitas = [];

foreach ($visitasProdutos as $produto) {
    $nomesProdutos[] = $produto['nomeproduto'];
    $quantidadeVisitas[] = $produto['visitas'];
}

// Convertendo arrays PHP para JSON, que será usado no JavaScript
$nomesProdutosJson = json_encode($nomesProdutos);
$quantidadeVisitasJson = json_encode($quantidadeVisitas);

?>

<?php
if (isset($_GET['msg'])):
?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['msg'] ?>
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
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title">Sales</h3>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Visitors Chart -->
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title">Visitas por Produtos</h3>
                </div>
                <div class="card-body">
                <canvas id="graficoVisitas" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Recebendo dados do PHP
    const nomesProdutos = <?= $nomesProdutosJson; ?>;
    const quantidadeVisitas = <?= $quantidadeVisitasJson; ?>;

    // Criando o gráfico
    const ctx = document.getElementById('graficoVisitas').getContext('2d');
    const graficoVisitas = new Chart(ctx, {
        type: 'polarArea', // Tipo de gráfico: barra
        data: {
            labels: nomesProdutos, // Nomes dos produtos
            datasets: [{
                label: 'Número de Visitas',
                data: quantidadeVisitas, // Quantidade de visitas
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Começar o eixo Y no zero
                }
            }
        }
    });
</script>




<?php
include "views/layout/rodape.php";
?>