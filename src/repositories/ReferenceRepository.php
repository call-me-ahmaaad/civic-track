<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Exceptions\DatabaseException;
use InvalidArgumentException;

class ReferenceRepository
{
    private array $referenceTable = ['cities', 'religions', 'education_levels', 'occupations', 'family_roles'];
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function exists(string $table, int $id)
    {
        if (!in_array($table, $this->referenceTable)) {
            throw new InvalidArgumentException('Table is not allowed');
        }

        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$table} WHERE id = :id");

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            throw new DatabaseException("Failed to count row from {$table}");
        }
    }
}