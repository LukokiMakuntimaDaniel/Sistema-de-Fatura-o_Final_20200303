<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sessão de Administração</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Barra de Navegação -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Administração</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="Home.html">Home</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="Fatura.html">Faturas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="CadastroCliente.html">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="CadastroProduto.html"> Cadastrar Produtos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="CadastroOperador.html">Cadastrar Operador</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="Relatório.html">Relatórios</a>
        </li>
        
      </ul>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <div class="container mt-5">
    <div class="row">
      <!-- Cartões de Estatísticas -->
      <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-header">Faturas Emitidas</div>
          <div class="card-body">
            <h5 class="card-title">150</h5>
            <p class="card-text">Total de faturas emitidas este mês.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
          <div class="card-header">Receita</div>
          <div class="card-body">
            <h5 class="card-title">Kzs 50.000,00</h5>
            <p class="card-text">Receita total deste mês.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
          <div class="card-header">Clientes</div>
          <div class="card-body">
            <h5 class="card-title">75</h5>
            <p class="card-text">Novos clientes este mês.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
          <div class="card-header">Produtos Vendidos</div>
          <div class="card-body">
            <h5 class="card-title">300</h5>
            <p class="card-text">Total de produtos vendidos este mês.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela de Faturas -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Lista de Faturas</h4>
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
                <tr>
                  <td>1</td>
                  <td>2024-06-18</td>
                  <td>Suzeth Canda</td>
                  <td>Kzs 1.000,00</td>
                  <td><span class="badge badge-success">Pago</span></td>
                  <td>
                    <button class="btn btn-primary btn-sm">Ver</button>
                    <button class="btn btn-warning btn-sm">Editar</button>
                    <button class="btn btn-danger btn-sm">Excluir</button>
                  </td>
                </tr>
                <!-- Adicione mais linhas conforme necessário -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
