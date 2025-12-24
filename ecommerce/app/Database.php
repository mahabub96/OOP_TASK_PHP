<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private string $host;
    private string $username;
    private string $database;
    private string $password;
    private ?PDO $connection = null;

    public function __construct(
        string $host,
        string $username,
        string $database,
        string $password = ''
    ) {
        $this->host     = $host;
        $this->username = $username;
        $this->database = $database;
        $this->password = $password;
    }

    /**
     *
     * @return PDO
     */
    public function connect(): PDO
    {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8";
                $this->connection = new PDO($dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Handle connection errors
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->connection;
    }


    public function disconnect(): void
    {
        $this->connection = null;
    }
}

?>
