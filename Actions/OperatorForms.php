<?php
include("../Controller/OperatorCRUD.php");
include("../Controller/UserCRUD.php");
include("../Model/Operator.php");
include("../Model/User.php");
include("../DataBase/DatabaseConnection.php");
$conetionBd = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
$OperatorCRUD = new OperatorCRUD($conetionBd);
$UserCRUD = new UserCRUD($conetionBd);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['userName'], $_POST['email'], $_POST['password'], $_POST['phoneNumber'], $_POST['userType'], $_POST['address'])) {
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phoneNumber = $_POST['phoneNumber'];
        $userType = $_POST['userType'];
        $address = $_POST['address'];
        $newUser = new User($userName, $email, $password, $phoneNumber, $userType, $address);
        $userId=$UserCRUD->create($newUser);
        $Operator = new Operator($userId);
        $returnId = $OperatorCRUD->create($Operator);
        if( $returnId){
            header('Location: ../Views/CadastroOperador.php');
        }
    } else {
        echo "Por favor, preencha todos os campos necessários.";
    }
}
