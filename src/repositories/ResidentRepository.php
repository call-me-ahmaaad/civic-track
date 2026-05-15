<?php

namespace App\Repositories;

use App\Exceptions\DatabaseException;
use App\Exceptions\NotFoundException;
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
                "SELECT identity_number, fullname, gender, cities.city AS birthplace, birthdate, religions.religion AS religion, education_levels.education AS education_level, occupations.occupation AS occupation, family_roles.role AS family_role, marital_status, family_id, created_at, updated_at 
                FROM residents 
                INNER JOIN cities ON cities.id = residents.birthplace_id
                INNER JOIN religions ON religions.id = residents.religion_id
                INNER JOIN education_levels ON education_levels.id = residents.education_level_id
                INNER JOIN occupations ON occupations.id = residents.occupation_id
                INNER JOIN family_roles ON family_roles.id = residents.family_role_id"
            );

            $stmt->execute();

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
                "SELECT identity_number, fullname, gender, cities.city AS birthplace, birthdate, religions.religion AS religion, education_levels.education AS education_level, occupations.occupation AS occupation, family_roles.role AS family_role, marital_status, family_id, created_at, updated_at 
                FROM residents 
                INNER JOIN cities ON cities.id = residents.birthplace_id
                INNER JOIN religions ON religions.id = residents.religion_id
                INNER JOIN education_levels ON education_levels.id = residents.education_level_id
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

    public function save(string $identityNumber, string $fullname, string $gender, int $birthplaceId, string $birthdate, int $religionId, int $educationLevelId, int $occupationId, int $familyRoleId, string $maritalStatus, string $familyId)
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO residents(identity_number, fullname, gender, birthplace_id, birthdate, religion_id, education_level_id, occupation_id, family_role_id, marital_status, family_id) 
                VALUES (:identity_number, :fullname, :gender, :birthplace_id, :birthdate, :religion_id, :education_level_id, :occupation_id, :family_role_id, :marital_status, :family_id)"
            );

            $stmt->execute([
                ":identity_number" => $identityNumber,
                ":fullname" => $fullname,
                ":gender" => $gender,
                ":birthplace_id" => $birthplaceId,
                ":birthdate" => $birthdate,
                ":religion_id" => $religionId,
                ":education_level_id" => $educationLevelId,
                ":occupation_id" => $occupationId,
                ":family_role_id" => $familyRoleId,
                ":marital_status" => $maritalStatus,
                ":family_id" => $familyId
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to insert a resident data from database');
        }
    }

    public function update(int $id, string $identityNumber, string $fullname, string $gender, int $birthplaceId, string $birthdate, int $religionId, int $educationLevelId, int $occupationId, int $familyRoleId, string $maritalStatus, string $familyId)
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
                    education_level_id = :education_level_id,
                    occupation_id = :occupation_id,
                    family_role_id = :family_role_id, 
                    marital_status = :marital_status, 
                    family_id = :family_id
                WHERE id = :id"
            );

            $stmt->execute([
                ":id" => $id,
                ":identity_number" => $identityNumber,
                ":fullname" => $fullname,
                ":gender" => $gender,
                ":birthplace_id" => $birthplaceId,
                ":birthdate" => $birthdate,
                ":religion_id" => $religionId,
                ":education_level_id" => $educationLevelId,
                ":occupation_id" => $occupationId,
                ":family_role_id" => $familyRoleId,
                ":marital_status" => $maritalStatus,
                ":family_id" => $familyId
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to update a resident data from database');
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