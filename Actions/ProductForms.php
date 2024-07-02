<?php
include("../DataBase/DatabaseConnection.php");
include("../Controller/ProductCRUD.php");
$conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $price = $_POST['prince'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $image = $_FILES["image"]["name"];
    $newProduct = new Product($productName, $description, $price, $amount, $category, $image);
    $ProductCRUD = new ProductCRUD($conetionBd);
    if ($ProductCRUD->create($newProduct)) {
        header("Location: ../views/CadastroProduto.php");
    }
}
