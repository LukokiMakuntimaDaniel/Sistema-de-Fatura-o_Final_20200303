<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Faturação</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .card-header h4 {
      margin-bottom: 0;
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
  <div class="container">
    <h1 class="mt-4">Relatório de Faturação</h1>
    <p class="lead">Relatório mensal de faturação para acompanhamento de desempenho.</p>

    <!-- Resumo dos Principais Indicadores -->

    <div class="row mb-4">
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

    <!-- Gráficos -->
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Receita por Mês</h4>
          </div>
          <div class="card-body">
            <canvas id="revenueChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
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

    <!-- Tabela de Faturas -->

    <div class="card mb-4">
      <div class="card-header">
        <h4>Faturas Emitidas</h4>
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

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  
  <script>
    // Dados fictícios para os gráficos
    const ctx1 = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
        datasets: [{
          label: 'Receita',
          data: [10000, 15000, 20000, 25000, 30000, 35000],
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
        labels: ['Produto A', 'Produto B', 'Produto C', 'Produto D', 'Produto E'],
        datasets: [{
          label: 'Vendas',
          data: [50, 75, 100, 125, 150],
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
  </script>


</body>

</html>