<?php
class InvoiceCRUD {
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }
    // Create a new invoice record
    public function create(Invoice $invoice) {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO invoices (productId, amount, total, invoiceDate) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "idss", 
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

    // Read an invoice record by ID
    public function read($invoiceId) {
        $stmt = mysqli_prepare($this->connection, "SELECT invoiceId, productId, amount, total, invoiceDate FROM invoices WHERE invoiceId = ?");
        mysqli_stmt_bind_param($stmt, "i", $invoiceId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $invoiceId, $productId, $amount, $total, $invoiceDate);

        if (mysqli_stmt_fetch($stmt)) {
            $invoice = new Invoice($productId, $amount, $total, $invoiceDate);
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
    public function update(Invoice $invoice) {
        $stmt = mysqli_prepare($this->connection, "UPDATE invoices SET productId = ?, amount = ?, total = ?, invoiceDate = ? WHERE invoiceId = ?");
        mysqli_stmt_bind_param($stmt, "idssi", 
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
    public function delete($invoiceId) {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM invoices WHERE invoiceId = ?");
        mysqli_stmt_bind_param($stmt, "i", $invoiceId);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
?>
