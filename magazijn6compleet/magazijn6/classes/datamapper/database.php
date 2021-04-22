<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 19-4-2021
 * Time: 19:00
 */

abstract class Database {

    // Variable for the connection
    private $conn;

    // Database login information
    private $host = 'localhost';
    private $db_name = 'magazijn6';
    private $username = 'root';
    private $password = '';

    /**
     * Function to get database connection
     *
     * @return conn the variable for the connection
     */
    public function getConnection() {
        $this->conn = null;

        // Checking if connection can be made, else show error
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';port=3306', $this->username, $this->password);
        } catch (\PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }
        // Connectie teruggeven
        return $this->conn;
    }
}
?>