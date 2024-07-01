<?php

class DatabaseConnection {
    private $connection;

    public function __construct($host, $user, $password, $database) {
        $this->connection = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        mysqli_close($this->connection);
    }
}


?>