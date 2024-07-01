<?php
class CompanyCRUD {
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    // Create a new company record
    public function create(Company $company) {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO companies (companyName, address, city, phoneNumber, email) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", 
            $company->getCompanyName(),
            $company->getAddress(),
            $company->getCity(),
            $company->getPhoneNumber(),
            $company->getEmail()
        );

        if (mysqli_stmt_execute($stmt)) {
            $companyId = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);
            return $companyId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Read a company record by ID
    public function read($companyId) {
        $stmt = mysqli_prepare($this->connection, "SELECT companyId, companyName, address, city, phoneNumber, email FROM companies WHERE companyId = ?");
        mysqli_stmt_bind_param($stmt, "i", $companyId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $companyId, $companyName, $address, $city, $phoneNumber, $email);

        if (mysqli_stmt_fetch($stmt)) {
            $company = new Company($companyName, $address, $city, $phoneNumber, $email);
            $reflection = new ReflectionClass($company);
            $property = $reflection->getProperty('companyId');
            $property->setAccessible(true);
            $property->setValue($company, $companyId);
            mysqli_stmt_close($stmt);
            return $company;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    // Update a company record
    public function update(Company $company) {
        $stmt = mysqli_prepare($this->connection, "UPDATE companies SET companyName = ?, address = ?, city = ?, phoneNumber = ?, email = ? WHERE companyId = ?");
        mysqli_stmt_bind_param($stmt, "sssssi", 
            $company->getCompanyName(),
            $company->getAddress(),
            $company->getCity(),
            $company->getPhoneNumber(),
            $company->getEmail(),
            $company->getCompanyId()
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    // Delete a company record by ID
    public function delete($companyId) {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM companies WHERE companyId = ?");
        mysqli_stmt_bind_param($stmt, "i", $companyId);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}

?>