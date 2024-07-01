<?php
class OperatorCRUD {
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    // Create a new operator record
    public function create(Operator $operator) {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO operators (userId) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "i", 
            $operator->getUserId()
        );

        if (mysqli_stmt_execute($stmt)) {
            $operatorId = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);
            return $operatorId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Read an operator record by ID
    public function read($operatorId) {
        $stmt = mysqli_prepare($this->connection, "SELECT operatorId, userId FROM operators WHERE operatorId = ?");
        mysqli_stmt_bind_param($stmt, "i", $operatorId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $operatorId, $userId);

        if (mysqli_stmt_fetch($stmt)) {
            $operator = new Operator($userId);
            $reflection = new ReflectionClass($operator);
            $property = $reflection->getProperty('operatorId');
            $property->setAccessible(true);
            $property->setValue($operator, $operatorId);
            mysqli_stmt_close($stmt);
            return $operator;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    // Update an operator record
    public function update(Operator $operator) {
        $stmt = mysqli_prepare($this->connection, "UPDATE operators SET userId = ? WHERE operatorId = ?");
        mysqli_stmt_bind_param($stmt, "ii", 
            $operator->getUserId(),
            $operator->getOperatorId()
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    // Delete an operator record by ID
    public function delete($operatorId) {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM operators WHERE operatorId = ?");
        mysqli_stmt_bind_param($stmt, "i", $operatorId);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
?>
