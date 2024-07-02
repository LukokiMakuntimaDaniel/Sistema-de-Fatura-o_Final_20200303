<!DOCTYPE html>
<html lang="pt">

<head>
  <script src="../js/js.js"></script>

  <?php
  include("../DataBase/DatabaseConnection.php");
  include("../Controller/ProductCRUD.php");
  $conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
  $ProductCRUD = new ProductCRUD($conetionBd);
  $produtos = $ProductCRUD->getAllProducts();
  foreach ($produtos as $produto) {
    echo "<script>";
    echo "inserirProdutos(";
    echo "{$produto->getProductId()}, ";
    echo "'{$produto->getProductName()}', ";
    echo "'{$produto->getDescription()}', ";
    echo "{$produto->getPrince()}, ";
    echo "{$produto->getAmount()}, ";
    echo "'{$produto->getCategory()}', ";
    echo "'{$produto->getImage()}')";
    echo "</script>";
  }
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Operador de Caixa</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <!-- Barra de Navegação -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Caixa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="Home.html">Home <span class="sr-only">(Home)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Vendas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Relatórios</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <!-- Formulário de Adição de Produto -->
        <div class="card">
          <div class="card-header">
            <h4>Adicionar Produto</h4>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="productCode">Selecione o Produto</label>
                <select name="product" id="productSelect" class="form-control">
                  <?php foreach ($produtos as $produto) : ?>
                    <option value="<?php echo $produto->getProductId(); ?>"><?php echo $produto->getProductName(); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="productName">Quantidade</label>
                <input type="number" class="form-control" id="qtd" placeholder="Digite o nome do produto" required>
              </div>
            </div>
            <button id="addProductForm" class="btn btn-primary">Adicionar</button>
          </div>
        </div>
        <!-- Tabela de Produtos Adicionados -->
        <div class="card mt-4">
          <div class="card-header">
            <h4>Produtos Adicionados</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nome</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
                  <th>Total</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody id="productList">
                <!-- Produtos serão adicionados aqui -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Resumo da Compra -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4>Resumo da Compra</h4>
          </div>
          <div class="card-body">
            <h5>Total a Pagar: Kzs <span id="totalAmount">0.00</span></h5>
            <button class="btn btn-success btn-block mt-3">Finalizar Compra</button>
            <button class="btn btn-danger btn-block mt-2">Cancelar Compra</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    // Script para calcular o total por produto e o total geral
    document.getElementById('addProductForm').addEventListener('click', function() {

      const code = document.getElementById('productSelect').value;
      const productoSelecionado = listaProdutos.filter((elemento) => elemento.productId == code);
      listaProdutos = listaProdutos.map(produto => {
        if (produto.productId == code) {
          return {
            ...produto,
            estado: 1
          }
        }
        return produto; // Retorna o produto sem alteração se não atender à condição
      });

      const codes = productoSelecionado[0].productId;
      const name = productoSelecionado[0].productName;
      const price = productoSelecionado[0].prince;
      const quantity = document.getElementById("qtd").value
      const total = parseFloat(quantity) * parseInt(price);

      const productList = document.getElementById('productList');
      const newRow = productList.insertRow();

      newRow.innerHTML = `
        <td>${codes}</td>
        <td>${name}</td>
        <td>${price.toFixed(2)}</td>
        <td>${quantity}</td>
        <td>${total.toFixed(2)}</td>
        <td>
          <button class="btn btn-danger btn-sm" onclick="removeProduct(this)">Remover</button>
        </td>
      `;
      updateTotalAmount();
      this.reset();
    });

    function removeProduct(button, id) {
      const row = button.parentElement.parentElement;
      listaProdutos = listaProdutos.filter(produto => produto.productId !== id);
      row.remove();
      updateTotalAmount();
    }

    function updateTotalAmount() {
      let totalAmount = 0;
      const productList = document.getElementById('productList').rows;
      for (let i = 0; i < productList.length; i++) {
        totalAmount += parseFloat(productList[i].cells[4].innerText);
      }
      document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
    }
  </script>
</body>

</html>