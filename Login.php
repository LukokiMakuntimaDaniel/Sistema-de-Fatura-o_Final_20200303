<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Login</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #cbdff4;
    }

    .login-form {
      width: 100%;
      max-width: 400px;
      padding: 15px;
      background: rgb(179, 178, 183);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(74, 72, 72, 0.1);
    }

    .login-form .form-group {
      margin-bottom: 1.5rem;
    }

    .login-form .btn-primary {
      width: 100%;
    }
  </style>

  <?php
  session_start();
  include("DataBase/DatabaseConnection.php");
  include("Controller/Login.php");

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userEmail = $_POST['email'];
    $password = $_POST['password'];

    $conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
    $userLogin = new Login($conetionBd);

    $user = $userLogin->authenticate($userEmail, $password);

    if ($user) {
      $_SESSION['user'] = $user;
      if ($user->getUserType() == 1) {
        header("Location: ./Views/Admin.php"); // Redireciona para o dashboard do administrador
      } elseif ($user->getUserType() == 2) {
        header("Location: ./Views/Operador.php"); // Redireciona para o dashboard do usuário
      }
    } else {
      $error = "Nome de usuário ou senha inválidos.";
    }
  }
  ?>
</head>

<body>
  <div class="container-fluid login-container">
    <div class="login-form">
      <h2 class="text-center mb-4">Login</h2>
      <form method="post" action="">
        <div class="form-group">
          <label for="email">Endereço de Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
        <?php if (isset($error)) : ?>
          <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>