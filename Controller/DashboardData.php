<?php
class DashboardData {
    private $connection;

    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    public function getTotalInvoices() {
        $result = mysqli_query($this->connection, "SELECT COUNT(*) AS total FROM invoices WHERE MONTH(invoceDate) = MONTH(CURDATE())");
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    public function getTotalRevenue() {
        $result = mysqli_query($this->connection, "SELECT SUM(total) AS revenue FROM invoices WHERE MONTH(invoceDate) = MONTH(CURDATE())");
        $data = mysqli_fetch_assoc($result);
        return $data['revenue'];
    }

    public function getTotalCustomers() {
        $result = mysqli_query($this->connection, "SELECT COUNT(*) AS total FROM customers WHERE MONTH(dateCustomer) = MONTH(CURDATE())");
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    public function getTotalProductsSold() {
        $result = mysqli_query($this->connection, "SELECT SUM(amount) AS total FROM invoices WHERE MONTH(invoceDate) = MONTH(CURDATE())");
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }
}
?>
