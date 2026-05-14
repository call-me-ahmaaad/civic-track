<?php

namespace App\Helpers;

use PDO;
use PDOException;
use App\Exceptions\DatabaseException;

class Database
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function connect(): PDO
    {
        $host = $this->config['host'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        $name = $this->config['name'];

        try {
            $conn = new PDO("mysql:host=$host;dbname=$name", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $error) {
            throw new DatabaseException("Failed to connect to database");
        }
    }
}