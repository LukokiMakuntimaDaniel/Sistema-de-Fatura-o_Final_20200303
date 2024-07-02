<?php
include("Model/User.php");
class Login {
    
    private $connection;

    public function __construct(DatabaseConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    public function authenticate($email, $password) {
        $stmt = mysqli_prepare($this->connection, "SELECT userId, userName, email, userType FROM users WHERE email = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $userId, $userName, $email, $userType);

        if (mysqli_stmt_fetch($stmt)) {
            $user = new User($userName, $email, null, null, $userType, null);
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
}
?>
