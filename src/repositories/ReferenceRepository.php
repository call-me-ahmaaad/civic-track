<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Exceptions\DatabaseException;
use InvalidArgumentException;

class ReferenceRepository
{
    private array $referenceTable = ['cities', 'religions', 'educations', 'occupations', 'family_roles'];
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function exists(string $table, int $id): bool
    {
        if (!in_array($table, $this->referenceTable)) {
            throw new InvalidArgumentException('Table is not allowed.');
        }

        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$table} WHERE id = :id");

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            throw new DatabaseException("Failed to check option/id from {$table}.");
        }
    }

    public function getCities(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, city FROM cities");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch cities from database.');
        }
    }

    public function getReligions(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, religion FROM religions");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch religions from database.');
        }
    }

    public function getEducations(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, education FROM educations");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch educations from database.');
        }
    }

    public function getOccupations(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, occupation FROM occupations");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch occupations from database.');
        }
    }

    public function getFamilyRoles(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, role FROM family_roles");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch family roles from database.');
        }
    }
}