<?php
include("../DataBase/DatabaseConnection.php");
include("../Controller/InvoiceCRUD.php");

// Configuração da conexão com o banco de dados
$dbConnection = new DatabaseConnection("localhost", "root", "", "SistemadeFatura");
$invoiceCRUD = new InvoiceCRUD($dbConnection);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        $orderInvoice = $data['orderInvoice'];
        $productId = $data['productId'];
        $amount = $data['amount'];
        $total = $data['total'];
        $invoiceDate = $data['invoiceDate'];

        $invoice = new Invoice($orderInvoice, $productId, $amount, $total, $invoiceDate);

        $invoiceId = $invoiceCRUD->create($invoice);

        if ($invoiceId !== false) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'invoiceId' => $invoiceId]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Erro ao inserir fatura no banco de dados']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Dados JSON inválidos']);
    }
} else {
    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Método não permitido']);
}
?>