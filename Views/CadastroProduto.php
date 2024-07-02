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
  <title>Cadastro de Produto</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">
            <h4>Cadastro de Produto</h4>
          </div>
          <div class="card-body">
            <form method="post" action="../Actions/ProductForms.php" enctype="multipart/form-data">
              <div class="form-group">
                <label for="productName">Nome do Produto</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Digite o nome do produto" required>
              </div>
              <div class="form-group">
                <label for="productDescription">Descrição do Produto</label>
                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Digite a descrição do produto" required></textarea>
              </div>
              <div class="form-group">
                <label for="productPrice">Preço</label>
                <input type="number" class="form-control" id="prince" name="prince" placeholder="Digite o preço do produto" required>
              </div>
              <div class="form-group">
                <label for="productQuantity">Quantidade</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Digite a quantidade do produto" required>
              </div>
              <div class="form-group">
                <label for="productCategory">Categoria</label>
                <select class="form-control" id="category" required name="category">
                  <option value="">Selecione a categoria</option>
                  <option value="Eletrônicos">Eletrônicos</option>
                  <option value="Roupas">Roupas</option>
                  <option value="Alimentos">Alimentos</option>
                  <option value="Livros">Livros</option>
                  <!-- Adicione mais opções conforme necessário -->
                </select>
              </div>
              <div class="form-group">
                <label for="productImage">Imagem do Produto</label>
                <input type="file" class="form-control-file" id="image" name="image" >
              </div>
              <button type="submit" class="btn btn-primary btn-block">Cadastrar Produto</button>
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