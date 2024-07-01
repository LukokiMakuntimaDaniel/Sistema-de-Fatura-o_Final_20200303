<?php
class CustomerCRUD {
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    // Create a new customer record
    public function create(Customer $customer) {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO customers (address, city, phoneNumber, email) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", 
            $customer->getAddress(),
            $customer->getCity(),
            $customer->getPhoneNumber(),
            $customer->getEmail()
        );

        if (mysqli_stmt_execute($stmt)) {
            $customerId = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);
            return $customerId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Read a customer record by ID
    public function read($customerId) {
        $stmt = mysqli_prepare($this->connection, "SELECT customerId, address, city, phoneNumber, email FROM customers WHERE customerId = ?");
        mysqli_stmt_bind_param($stmt, "i", $customerId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $customerId, $address, $city, $phoneNumber, $email);

        if (mysqli_stmt_fetch($stmt)) {
            $customer = new Customer($address, $city, $phoneNumber, $email);
            $reflection = new ReflectionClass($customer);
            $property = $reflection->getProperty('customerId');
            $property->setAccessible(true);
            $property->setValue($customer, $customerId);
            mysqli_stmt_close($stmt);
            return $customer;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    // Update a customer record
    public function update(Customer $customer) {
        $stmt = mysqli_prepare($this->connection, "UPDATE customers SET address = ?, city = ?, phoneNumber = ?, email = ? WHERE customerId = ?");
        mysqli_stmt_bind_param($stmt, "ssssi", 
            $customer->getAddress(),
            $customer->getCity(),
            $customer->getPhoneNumber(),
            $customer->getEmail(),
            $customer->getCustomerId()
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    // Delete a customer record by ID
    public function delete($customerId) {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM customers WHERE customerId = ?");
        mysqli_stmt_bind_param($stmt, "i", $customerId);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}

?>
