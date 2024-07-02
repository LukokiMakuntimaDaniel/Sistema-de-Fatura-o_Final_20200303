<?php
session_start();
if (!isset($_SESSION['user'])) {
   header('Location:../index.php');
}// Faça algo diferente aqui, se necessário
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Faturação</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    #sidebar {
      height: 100vh;
      background-color: #136dc6;
      padding: 20px;
    }

    #sidebar .nav-link {
      color: #fff;
    }

    #sidebar .nav-link.active {
      background-color: #0a78ee;
      color: #fff;
    }

    #content {
      padding: 20px;
    }
  </style>
  <?php
  include("../DataBase/DatabaseConnection.php");
  include("../Controller/DashboardData.php");
  include("../Controller/InvoiceCRUD.php");
  $conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
  $dashboardData = new DashboardData($conetionBd);
  $totalInvoices = $dashboardData->getTotalInvoices();
  $totalRevenue = $dashboardData->getTotalRevenue() ?? 0;
  $totalCustomers = $dashboardData->getTotalCustomers();
  $totalProductsSold = $dashboardData->getTotalProductsSold() ?? 0;
  $invoiceCRUD = new InvoiceCRUD($conetionBd);
  $invoices = $invoiceCRUD->getAllInvoices();
  ?>

</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Painel Lateral -->
      <nav id="sidebar" class="col-md-2 d-none d-md-block bg-dark">
        <div class="sidebar-sticky">
          <h5 class="text-white">Sistema de Faturação</h5>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="fas fa-tachometer-alt"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Fatura.php">
                <i class="fas fa-file-invoice"></i> Faturas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Empresa.php">
                <i class="fas fa-users"></i> Empresas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./CadastroProduto.php">
                <i class="fas fa-boxes"></i> Produtos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Relatório.php">
                <i class="fas fa-chart-bar"></i> Relatórios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Controller/terminarSessao.php">
                <i class=""></i> Iniciar Sessão
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Conteúdo Principal -->
      <main id="content" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>

        <div class="row">
          <!-- Cartões de Estatísticas -->
          <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
              <div class="card-header">Faturas Emitidas</div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $totalInvoices; ?></h5>
                <p class="card-text">Total de faturas emitidas este mês.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
              <div class="card-header">Receita</div>
              <div class="card-body">
                <h5 class="card-title">KZS <?php echo number_format($totalRevenue, 2, ',', '.'); ?></h5>
                <p class="card-text">Receita total deste mês.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
              <div class="card-header">Clientes</div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $totalCustomers; ?></h5>
                <p class="card-text">Novos clientes este mês.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
              <div class="card-header">Produtos Vendidos</div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $totalProductsSold; ?></h5>
                <p class="card-text">Total de produtos vendidos este mês.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Gráficos e Tabela de Faturas Recentes -->
        <div class="row">
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="card-header">
                <h4>Faturas Recentes</h4>
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Data</th>
                      <th>Cliente</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($invoices as $invoice) : ?>
                      <tr>
                        <td><?php echo $invoice->getInvoiceId(); ?></td>
                        <td><?php echo $invoice->getInvoiceDate(); ?></td>
                        <td><?php echo "Cliente Exemplo"; // Substitua por lógica para obter o nome do cliente 
                            ?></td>
                        <td><?php echo number_format($invoice->getTotal(), 2, ',', '.'); ?></td>
                        <td><span class="badge badge-success">Pago</span></td> <!-- Substitua por lógica de status real -->
                        <td>
                          <button class="btn btn-primary btn-sm">Ver</button>
                          <button class="btn btn-warning btn-sm">Editar</button>
                          <button class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                <h4>Receita por Mês</h4>
              </div>
              <div class="card-body">
                <canvas id="revenueChart"></canvas>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4>Produtos Mais Vendidos</h4>
              </div>
              <div class="card-body">
                <canvas id="topProductsChart"></canvas>
              </div>
            </div>
          </div>
        </div>


      </main>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Função para buscar os dados do servidor e atualizar os gráficos
    function atualizarGraficos() {
      // AJAX para buscar os dados de receita por mês
      fetch('../Actions/getChartData.php')
        .then(response => response.json())
        .then(data => {
          const ctx1 = document.getElementById('revenueChart').getContext('2d');
          const revenueChart = new Chart(ctx1, {
            type: 'line',
            data: {
              labels: data.receitaPorMes.map(item => item.mes), // Labels dos meses
              datasets: [{
                label: 'Receita',
                data: data.receitaPorMes.map(item => item.receita), // Dados de receita por mês
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              }
            }
          });

          const ctx2 = document.getElementById('topProductsChart').getContext('2d');
          const topProductsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
              labels: data.produtosMaisVendidos.map(item => item.productName), // Labels dos produtos
              datasets: [{
                label: 'Vendas',
                data: data.produtosMaisVendidos.map(item => item.vendas), // Dados de vendas dos produtos
                backgroundColor: [
                  'rgba(255, 99, 132, 0.5)',
                  'rgba(54, 162, 235, 0.5)',
                  'rgba(255, 206, 86, 0.5)',
                  'rgba(75, 192, 192, 0.5)',
                  'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              }
            }
          });
        })
        .catch(error => {
          console.error('Erro ao buscar dados do servidor:', error);
          alert('Erro ao buscar dados do servidor. Verifique o console para mais detalhes.');
        });
    }

    // Chama a função para atualizar os gráficos ao carregar a página
    atualizarGraficos()
  </script>
</body>

</html>