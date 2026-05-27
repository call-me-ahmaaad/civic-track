<?php

namespace App\Repositories;

use App\Exceptions\{DatabaseException, NotFoundException};
use PDO;
use PDOException;

class ResidentRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT residents.id as resident_id, identity_number, fullname, gender, birthdate, families.id as family_id, residents.family_card_number as family_card_number
                FROM residents
                INNER JOIN families ON residents.family_card_number = families.family_card_number"
            );

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch residents data from database');
        }
    }

    public function findByFamilyCardNumber(string $familyCardNumber)
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT residents.id as id, identity_number, fullname, gender, birthdate, family_card_number, family_roles.role AS family_role
                FROM residents 
                INNER JOIN family_roles ON family_roles.id = residents.family_role_id
                WHERE family_card_number = :family_card_number"
            );

            $stmt->execute([
                ":family_card_number" => $familyCardNumber
            ]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch residents data from database');
        }
    }

    public function findById(int $id)
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT residents.id as id, identity_number, fullname, gender, cities.city AS birthplace, birthdate, religions.religion AS religion, educations.education AS education, occupations.occupation AS occupation, family_roles.role AS family_role, marital_status, family_card_number, created_at, updated_at 
                FROM residents 
                INNER JOIN cities ON cities.id = residents.birthplace_id
                INNER JOIN religions ON religions.id = residents.religion_id
                INNER JOIN educations ON educations.id = residents.education_id
                INNER JOIN occupations ON occupations.id = residents.occupation_id
                INNER JOIN family_roles ON family_roles.id = residents.family_role_id
                WHERE residents.id = :id"
            );

            $stmt->execute([
                ":id" => $id
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new NotFoundException('Resident data not found');
            }

            return $result;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch residents data from database');
        }
    }

    public function save(string $identityNumber, string $fullname, string $gender, int $birthplaceId, string $birthdate, int $religionId, int $educationId, int $occupationId, int $familyRoleId, string $maritalStatus, string $familyCardNumber)
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO residents(identity_number, fullname, gender, birthplace_id, birthdate, religion_id, education_id, occupation_id, family_role_id, marital_status, family_card_number) 
                VALUES (:identity_number, :fullname, :gender, :birthplace_id, :birthdate, :religion_id, :education_id, :occupation_id, :family_role_id, :marital_status, :family_card_number)"
            );

            $stmt->execute([
                ":identity_number" => $identityNumber,
                ":fullname" => $fullname,
                ":gender" => $gender,
                ":birthplace_id" => $birthplaceId,
                ":birthdate" => $birthdate,
                ":religion_id" => $religionId,
                ":education_id" => $educationId,
                ":occupation_id" => $occupationId,
                ":family_role_id" => $familyRoleId,
                ":marital_status" => $maritalStatus,
                ":family_card_number" => $familyCardNumber
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to insert a resident data to database');
        }
    }

    public function update(int $id, string $identityNumber, string $fullname, string $gender, int $birthplaceId, string $birthdate, int $religionId, int $educationId, int $occupationId, int $familyRoleId, string $maritalStatus, string $familyCardNumber)
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE residents 
                SET identity_number = :identity_number, 
                    fullname = :fullname, 
                    gender = :gender, 
                    birthplace_id = :birthplace_id, 
                    birthdate = :birthdate, 
                    religion_id = :religion_id,
                    education_id = :education_id,
                    occupation_id = :occupation_id,
                    family_role_id = :family_role_id, 
                    marital_status = :marital_status, 
                    family_card_number = :family_card_number
                WHERE id = :id"
            );

            $stmt->execute([
                ":identity_number" => $identityNumber,
                ":fullname" => $fullname,
                ":gender" => $gender,
                ":birthplace_id" => $birthplaceId,
                ":birthdate" => $birthdate,
                ":religion_id" => $religionId,
                ":education_id" => $educationId,
                ":occupation_id" => $occupationId,
                ":family_role_id" => $familyRoleId,
                ":marital_status" => $maritalStatus,
                ":family_card_number" => $familyCardNumber,
                ":id" => $id
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to update a resident data to database');
        }
    }

    public function delete(int $id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM residents WHERE id = :id");

            $stmt->execute([
                ":id" => $id,
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to delete a resident data from database');
        }
    }
}