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

    .table th,
    .table td {
      vertical-align: middle;
    }
  </style>
  <?php
  include("../DataBase/DatabaseConnection.php");
  include("../Controller/CompanyCRUD.php");
  $conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
  $companyCRUD = new CompanyCRUD($conetionBd);
  $empresa = $companyCRUD->readSingleCompany();
  ?>

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
            <?php
            if ($empresa) {
              echo '<p>';
              echo '<strong>' . htmlspecialchars($empresa->getCompanyName()) . '</strong><br>';
              echo htmlspecialchars($empresa->getAddress()) . '<br>';
              echo htmlspecialchars($empresa->getCity()) . ', ' . htmlspecialchars($empresa->getPhoneNumber()) . '<br>';
              echo 'Telefone: ' . htmlspecialchars($empresa->getPhoneNumber()) . '<br>';
              echo 'Email: ' . htmlspecialchars($empresa->getEmail());
              echo '</p>';
            } else {
              echo '<p>Dados da empresa não encontrados.</p>';
            }
            ?>
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
            <h5 id="dataFactura"> </h5>
          </div>
          <div class="col-md-6 text-right">
            <h5 id="numeroFactura">Fatura</h5>
          </div>
        </div>

        <div class="table-responsive mt-4" id="tabelaProdutos">
          
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
                  <td id="Subtotal"></td>
                </tr>
                <tr>
                  <th>Imposto (14%):</th>
                  <td id="iva"></td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td id="total"><strong></strong></td>
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
  <script src="../js/js.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    criarTabelaProdutos();
  </script>
</body>

</html>