<?php
class UserCRUD {
    private $connection;

    // Constructor to initialize database connection
    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    // Create a new user record
    public function create(User $user) {
        $stmt = mysqli_prepare($this->connection, "INSERT INTO users (userName, email, password, phoneNumber, userType, address) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssss", 
            $user->getUserName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhoneNumber(),
            $user->getUserType(),
            $user->getAddress()
        );

        if (mysqli_stmt_execute($stmt)) {
            $userId = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);
            return $userId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Read a user record by ID
    public function read($userId) {
        $stmt = mysqli_prepare($this->connection, "SELECT userId, userName, email, password, phoneNumber, userType, address FROM users WHERE userId = ?");
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $userId, $userName, $email, $password, $phoneNumber, $userType, $address);

        if (mysqli_stmt_fetch($stmt)) {
            $user = new User($userName, $email, $password, $phoneNumber, $userType, $address);
            $reflection = new ReflectionClass($user);
            $property = $reflection->getProperty('userId');
            $property->setAccessible(true);
            $property->setValue($user, $userId);
            mysqli_stmt_close($stmt);
            return $user;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    // Update a user record
    public function update(User $user) {
        $stmt = mysqli_prepare($this->connection, "UPDATE users SET userName = ?, email = ?, password = ?, phoneNumber = ?, userType = ?, address = ? WHERE userId = ?");
        mysqli_stmt_bind_param($stmt, "ssssssi", 
            $user->getUserName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhoneNumber(),
            $user->getUserType(),
            $user->getAddress(),
            $user->getUserId()
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    // Delete a user record by ID
    public function delete($userId) {
        $stmt = mysqli_prepare($this->connection, "DELETE FROM users WHERE userId = ?");
        mysqli_stmt_bind_param($stmt, "i", $userId);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
?>
