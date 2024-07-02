<?php
session_start();
if (!isset($_SESSION['user'])) {
   header('Location:../Login.php');
}// Faça algo diferente aqui, se necessário
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Empresa</title>
  <!-- Incluindo o CSS do Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white">
            Cadastro de Empresa
          </div>
          <div class="card-body">
            <!-- Formulário de Cadastro -->
            <form method="post" action="../Actions/CompanyForms.php">
              <!-- Nome da Empresa -->
              <div class="form-group">
                <label for="nome">Nome da Empresa</label>
                <input type="text" class="form-control" id="nome" name="companyName" required>
              </div>

              <!-- Endereço -->
              <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="address" required>
              </div>

              <!-- Cidade e Estado -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cidade">Cidade</label>
                  <input type="text" class="form-control" id="cidade" name="city" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="estado">Estado</label>
                  <select id="estado" class="form-control" name="estado" required>
                    <option selected disabled>Selecione...</option>
                    <option value="AC">Luanda</option>
                    <option value="AL">Cacuaco</option>
                    <option value="AP">Viana</option>
                    <!-- Adicione outras opções conforme necessário -->
                  </select>
                </div>
              </div>

              <!-- Telefone -->
              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" class="form-control" id="telefone" name="phoneNumber" required>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <!-- Botão de Envio -->
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Incluindo o JavaScript do Bootstrap (opcional, mas recomendado para funcionalidades como dropdowns) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>