<?php

namespace App\Repositories;

use App\Exceptions\{DatabaseException, NotFoundException};
use PDO;
use PDOException;

class FamilyRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, family_card_number, address, neighborhood_unit, community_unit FROM families");

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch families data from database');
        }
    }

    public function findById(int $id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, family_card_number, address, neighborhood_unit, community_unit, created_at, updated_at FROM families WHERE id = :id");

            $stmt->execute([
                ":id" => $id
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new NotFoundException('Family data not found');
            }

            return $result;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch a family data from database');
        }
    }

    public function save(string $familyCardNumber, string $address, string $neighborhoodUnit, string $communityUnit)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO families(family_card_number, address, neighborhood_unit, community_unit) VALUES (:family_card_number, :address, :neighborhood_unit, :community_unit)");

            $stmt->execute([
                ":family_card_number" => $familyCardNumber,
                ":address" => $address,
                ":neighborhood_unit" => $neighborhoodUnit,
                ":community_unit" => $communityUnit
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to insert a family data to database');
        }
    }

    public function update(int $id, string $familyCardNumber, string $address, string $neighborhoodUnit, string $communityUnit)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE families SET family_card_number = :family_card_number, address = :address, neighborhood_unit = :neighborhood_unit, community_unit = :community_unit WHERE id = :id");

            $stmt->execute([
                ":family_card_number" => $familyCardNumber,
                ":address" => $address,
                ":neighborhood_unit" => $neighborhoodUnit,
                ":community_unit" => $communityUnit,
                ":id" => $id
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to update a family data to database');
        }
    }

    public function delete(int $id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM families WHERE id = :id");

            $stmt->execute([
                ":id" => $id,
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to delete a family data from database');
        }
    }
}