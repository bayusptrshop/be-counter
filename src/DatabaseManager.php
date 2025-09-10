<?php

class DatabaseManager {
    private $conn;

    public function __construct($config) {
        $this->conn = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database'],
            $config['port'],
            $config['socket']
        );

        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error . "\n");
        }

        echo "Koneksi database berhasil.\n";
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}