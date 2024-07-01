<?php
include("../DataBase/DatabaseConnection.php");
include("../Controller/CompanyCRUD.php");
include("../Model/Company.php");

$conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
$CompanyCRUD = new CompanyCRUD($conetionBd);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['companyName'], $_POST['address'], $_POST['city'], $_POST['phoneNumber'], $_POST['email'])) {
        $companyName = $_POST['companyName'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $newCompany = new Company($companyName, $address, $city, $phoneNumber, $email);
        if($CompanyCRUD->create($newCompany)) {
            header('Location:../views/empresa.php');
        }
    } else {
        echo "Por favor, preencha todos os campos necessários.";
    }
}
?>
