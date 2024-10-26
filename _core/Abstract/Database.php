<?php

namespace Atova\Eshoper\Abstract;

use PDO;
use PDOException;

class Database {

    // Database credentials and option
    private $driver;
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $db;
    private $stmt;
    private $error;

    // Constructor to initialize DB configuration
    public function __construct() {
        $this->driver = config("database.DB_DRIVER","mysql");
        $this->host = config("database.DB_HOST","localhost");
        $this->user = config("database.DB_USER","root");   
        $this->password = config("database.DB_PASSWORD",null);
        $this->dbname = config("database.DB_NAME","lab27");
    }

    // Lazy load database connection
    private function connect() {
        if (!$this->db instanceof PDO) {
            $dsn = "{$this->driver}:host={$this->host};dbname={$this->dbname}";
            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            try {
                $this->db = new PDO($dsn, $this->user, $this->password, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }
        return $this->db;
    }

    // Prepare a statement with the given SQL query
    public function query($sql) {
        if ($this->connect()) {
            $this->stmt = $this->db->prepare($sql);
        } else {
            handleException("Failed to establish database connection. The error is: ".$this->error);
        }
    }

    // Bind values to the prepared statement
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute(): bool {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    // Fetch results as an array of objects (fetch all or a single result)
    public function results($all = true) {
        $this->execute();
        return $all ? $this->stmt->fetchAll(PDO::FETCH_OBJ) : $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get the row count
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    // Get the last inserted ID
    public function getLastInsertedId() {
        return $this->db->lastInsertId();
    }

    // Get the error details
    public function getErrors(): bool|string {
        return $this->error ? implode(PHP_EOL, $this->stmt->errorInfo()) : false;
    }

    // Test the DB connection (for debugging)
    public function testDbConnection() {
        if (!$this->connect()) {
            handleException("Failed to establish database connection. The error is: ".$this->error);
        }
    }
}
