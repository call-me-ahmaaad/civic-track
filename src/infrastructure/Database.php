<?php

namespace App\Infrastructure;

use PDO;
use PDOException;
use App\Exceptions\DatabaseException;

class Database
{
    private array $env;

    public function __construct(array $env)
    {
        $this->env = $env;
    }

    public function connect(): PDO
    {
        $host = $this->env['host'];
        $port = $this->env['port'];
        $name = $this->env['name'];
        $username = $this->env['username'];
        $password = $this->env['password'];
        $charset = $this->env['charset'];

        try {
            $conn = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=$charset", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $error) {
            throw new DatabaseException("Failed to connect to database");
        }
    }
}