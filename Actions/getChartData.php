<?php
include("../DataBase/DatabaseConnection.php");

// Configuração da conexão com o banco de dados
$dbConnection = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");

// Consulta para obter os dados de receita por mês
$queryReceita = "SELECT MONTH(invoices.invoiceDate) as mes, SUM(invoices.total) as receita 
                 FROM invoices 
                 GROUP BY MONTH(invoices.invoiceDate)";
$resultReceita = mysqli_query($dbConnection->getConnection(), $queryReceita);
$receitaPorMes = [];
while ($row = mysqli_fetch_assoc($resultReceita)) {
    $receitaPorMes[] = $row;
}

// Consulta para obter os produtos mais vendidos
$queryProdutos = "SELECT products.productName, SUM(invoices.amount) as vendas 
                  FROM invoices 
                  JOIN products ON invoices.productId = products.productId 
                  GROUP BY products.productName 
                  ORDER BY vendas DESC 
                  LIMIT 5";
$resultProdutos = mysqli_query($dbConnection->getConnection(), $queryProdutos);
$produtosMaisVendidos = [];
while ($row = mysqli_fetch_assoc($resultProdutos)) {
    $produtosMaisVendidos[] = $row;
}

// Retorna os dados em formato JSON
echo json_encode([
    'receitaPorMes' => $receitaPorMes,
    'produtosMaisVendidos' => $produtosMaisVendidos
]);
