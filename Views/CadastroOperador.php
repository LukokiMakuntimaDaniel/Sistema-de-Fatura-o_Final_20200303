<?php
session_start();
if (!isset($_SESSION['user'])) {
   header('Location:../Login.php');
}// Faça algo diferente aqui, se necessário
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Cadastro de Usuário</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h4>Cadastro de Usuário</h4>
          </div>
          <div class="card-body">
            <form method="post" action="../Actions/OperatorForms.php">
              <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" class="form-control" id="userName" name="userName" placeholder="Digite seu nome completo" required>
              </div>
              <div class="form-group">
                <label for="email">Endereço de Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirme a Senha</label>
                <input type="password" class="form-control" id="confirm-password" placeholder="Confirme sua senha" required>
              </div>
              <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"  placeholder="Digite seu telefone" required>
              </div>
              <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Digite seu endereço" required>
              </div>
              <div class="form-group" style="display: none;">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="userType" name="userType" value="2" placeholder="Digite seu endereço" required>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">Eu aceito os <a href="#">termos e condições</a></label>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </form>
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