<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fatura</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }
    .invoice-header {
      background-color: rgb(179, 178, 183);
      color: #fff;
      padding: 20px;
    }
    .invoice-body {
      padding: 20px;
    }
    .invoice-footer {
      background-color: rgb(179, 178, 183);
      padding: 20px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="card">
      <div class="card-header invoice-header">
        <h2>Fatura</h2>
      </div>
      <div class="card-body invoice-body">
        <div class="row">
          <div class="col-md-6">
            <h4>De:</h4>
            <p>
              <strong>Nome da Empresa</strong><br>
              Endereço da Empresa<br>
              Cidade, Estado, CEP<br>
              Telefone: (00) 0000-0000<br>
              Email: empresa@example.com
            </p>
          </div>
          <div class="col-md-6 text-right">
            <h4>Para:</h4>
            <p>
              <strong>Nome do Cliente</strong><br>
              Endereço do Cliente<br>
              Cidade, Estado, CEP<br>
              Telefone: (00) 0000-0000<br>
              Email: cliente@example.com
            </p>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
            <h5>Data da Fatura: 2024-06-18</h5>
          </div>
          <div class="col-md-6 text-right">
            <h5>Fatura #: 0001</h5>
          </div>
        </div>

        <div class="table-responsive mt-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Produto A</td>
                <td>2</td>
                <td>R$ 100,00</td>
                <td>R$ 200,00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Produto B</td>
                <td>3</td>
                <td>R$ 150,00</td>
                <td>R$ 450,00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Serviço X</td>
                <td>1</td>
                <td>R$ 500,00</td>
                <td>R$ 500,00</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
            <h5>Observações:</h5>
            <p>Obrigado pela sua preferência!</p>
          </div>
          <div class="col-md-6 text-right">
            <table class="table">
              <tbody>
                <tr>
                  <th>Subtotal:</th>
                  <td>R$ 1.150,00</td>
                </tr>
                <tr>
                  <th>Imposto (10%):</th>
                  <td>R$ 115,00</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td><strong>R$ 1.265,00</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card-footer invoice-footer text-center">
        <p>Fatura gerada por Sistema de Faturação | www.sistemadefaturacao.com</p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
