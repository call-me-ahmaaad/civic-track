<?php

namespace App\Repositories;

use App\Exceptions\{DatabaseException, NotFoundException};
use App\Models\Family;
use PDO;
use PDOException;

class FamilyRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, family_card_number, address, neighborhood_unit, community_unit FROM families");

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $families = array_map(function ($result) {
                $family = new Family();
                $family->setId($result['id']);
                $family->setFamilyCardNumber($result['family_card_number']);
                $family->setAddress($result['address']);
                $family->setNeighborhoodUnit($result['neighborhood_unit']);
                $family->setCommunityUnit($result['community_unit']);

                return $family;
            }, $results);

            return $families ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch family records from database.');
        }
    }

    public function findById(int $id): Family
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, family_card_number, address, neighborhood_unit, community_unit, created_at, updated_at FROM families WHERE id = :id");

            $stmt->execute([
                ":id" => $id
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new NotFoundException('Family record not found.');
            }

            $family = new Family();
            $family->setId($result['id']);
            $family->setFamilyCardNumber($result['family_card_number']);
            $family->setAddress($result['address']);
            $family->setNeighborhoodUnit($result['neighborhood_unit']);
            $family->setCommunityUnit($result['community_unit']);
            $family->setCreatedAt($result['created_at']);
            $family->setUpdatedAt($result['updated_at']);

            return $family;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch a family record from database.');
        }
    }

    public function isIdExist(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM families WHERE id = :id");

            $stmt->execute([
                ":id" => $id
            ]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to check if ID exist or not in database.');
        }
    }

    public function isFamilyCardNumberTaken(string $familyCardNumber): bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM families WHERE family_card_number = :family_card_number");

            $stmt->execute([
                ":family_card_number" => $familyCardNumber
            ]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to check a family card number from database.');
        }
    }

    public function isFamilyCardNumberTakenByOther(string $familyCardNumber, int $excludeId): bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM families WHERE family_card_number = :family_card_number AND id != :exclude_id");

            $stmt->execute([
                ":family_card_number" => $familyCardNumber,
                ":exclude_id" => $excludeId
            ]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to check a family card number from database.');
        }
    }

    public function save(Family $family): void
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO families(family_card_number, address, neighborhood_unit, community_unit) VALUES (:family_card_number, :address, :neighborhood_unit, :community_unit)");

            $stmt->execute([
                ":family_card_number" => $family->getFamilyCardNumber(),
                ":address" => $family->getAddress(),
                ":neighborhood_unit" => $family->getNeighborhoodUnit(),
                ":community_unit" => $family->getCommunityUnit()
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to insert a family record to database.');
        }
    }

    public function update(Family $family): void
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE families SET family_card_number = :family_card_number, address = :address, neighborhood_unit = :neighborhood_unit, community_unit = :community_unit WHERE id = :id");

            $stmt->execute([
                ":family_card_number" => $family->getFamilyCardNumber(),
                ":address" => $family->getAddress(),
                ":neighborhood_unit" => $family->getNeighborhoodUnit(),
                ":community_unit" => $family->getCommunityUnit(),
                ":id" => $family->getId()
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to update a family record to database.');
        }
    }

    public function delete(int $id): void
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM families WHERE id = :id");

            $stmt->execute([
                ":id" => $id,
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to delete a family record from database.');
        }
    }
}