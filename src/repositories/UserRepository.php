<?php

namespace App\Repositories;

use App\Exceptions\DatabaseException;
use App\Exceptions\NotFoundException;
use PDO;
use PDOException;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByUsername(string $username)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT username, password FROM users WHERE username = :username");

            $stmt->execute([
                ":username" => $username
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$result){
                throw new NotFoundException("Username $username isn't registered as admin");
            }

            return $result;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch a user data from database');
        }
    }
}