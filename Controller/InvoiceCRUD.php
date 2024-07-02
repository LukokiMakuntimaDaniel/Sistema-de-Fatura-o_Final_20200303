<?php
include("../Model/Invoice.php");
class InvoiceCRUD
{
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->connection = $dbConnection->getConnection();
    }

    // Create a new invoice record
    public function create(Invoice $invoice)
    {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO invoices (orderInvoice, productId, amount, total, invoiceDate) VALUES (?, ?, ?, ?, ?)");

        // Verifique se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            return false;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "siifs",
            $invoice->getOrderInvoice(),
            $invoice->getProductId(),
            $invoice->getAmount(),
            $invoice->getTotal(),
            $invoice->getInvoiceDate()
        );

        if (mysqli_stmt_execute($stmt)) {
            $invoiceId = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);
            return $invoiceId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }


    public function getAllInvoices()
    {
        $stmt = mysqli_prepare($this->connection, "SELECT invoiceId, orderInvoice, productId, amount, total, invoiceDate FROM invoices");
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $invoices = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $invoice = new Invoice($row['orderInvoice'], $row['productId'], $row['amount'], $row['total'], $row['invoiceDate']);
            $reflection = new ReflectionClass($invoice);
            $property = $reflection->getProperty('invoiceId');
            $property->setAccessible(true);
            $property->setValue($invoice, $row['invoiceId']);
            $invoices[] = $invoice;
        }
        mysqli_stmt_close($stmt);
        return $invoices;
    }

    // Read an invoice record by ID
    public function read($invoiceId)
    {
        $stmt = mysqli_prepare($this->connection, "SELECT invoiceId, orderInvoice, productId, amount, total, invoiceDate FROM invoices WHERE invoiceId = ?");
        mysqli_stmt_bind_param($stmt, "i", $invoiceId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $invoiceId, $orderInvoice, $productId, $amount, $total, $invoiceDate);

        if (mysqli_stmt_fetch($stmt)) {
            $invoice = new Invoice($orderInvoice, $productId, $amount, $total, $invoiceDate);
            $reflection = new ReflectionClass($invoice);
            $property = $reflection->getProperty('invoiceId');
            $property->setAccessible(true);
            $property->setValue($invoice, $invoiceId);
            mysqli_stmt_close($stmt);
            return $invoice;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    // Update an invoice record
    public function update(Invoice $invoice)
    {
        $stmt = mysqli_prepare($this->connection, "UPDATE invoices SET orderInvoice = ?, productId = ?, amount = ?, total = ?, invoiceDate = ? WHERE invoiceId = ?");
        mysqli_stmt_bind_param(
            $stmt,
            "siidsi",
            $invoice->getOrderInvoice(),
            $invoice->getProductId(),
            $invoice->getAmount(),
            $invoice->getTotal(),
            $invoice->getInvoiceDate(),
            $invoice->getInvoiceId()
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    // Delete an invoice record by ID
    public function delete($invoiceId)
    {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM invoices WHERE invoiceId = ?");
        mysqli_stmt_bind_param($stmt, "i", $invoiceId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function countInvoices()
    {
        $stmt = mysqli_prepare($this->connection, "SELECT COUNT(*) as count FROM invoices");
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $count;
    }

    public function getInvoicesByOrderInvoice($orderInvoice)
    {
        $stmt = mysqli_prepare($this->connection, "SELECT invoiceId, productId, amount, total, invoiceDate FROM invoices WHERE orderInvoice = ?");
        mysqli_stmt_bind_param($stmt, "s", $orderInvoice);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $invoices = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $invoice = new Invoice($orderInvoice, $row['productId'], $row['amount'], $row['total'], $row['invoiceDate']);
            $reflection = new ReflectionClass($invoice);
            $property = $reflection->getProperty('invoiceId');
            $property->setAccessible(true);
            $property->setValue($invoice, $row['invoiceId']);
            $invoices[] = $invoice;
        }
        mysqli_stmt_close($stmt);
        return $invoices;
    }
}
