<?php

namespace App\Repositories;

use App\Exceptions\{DatabaseException, NotFoundException};
use App\Models\Resident;
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

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $residents = array_map(function ($result) {
                $resident = new Resident();
                $resident->setId($result['resident_id']);
                $resident->setIdentityNumber($result['identity_number']);
                $resident->setFullname($result['fullname']);
                $resident->setGender($result['gender']);
                $resident->setBirthdate($result['birthdate']);
                $resident->setFamilyId($result['family_id']);
                $resident->setFamilyCardNumber($result['family_card_number']);

                return $resident;
            }, $results);

            return $residents ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch resident records from database.');
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

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $residents = array_map(function ($result) {
                $resident = new Resident();
                $resident->setId($result['id']);
                $resident->setIdentityNumber($result['identity_number']);
                $resident->setFullname($result['fullname']);
                $resident->setGender($result['gender']);
                $resident->setBirthdate($result['birthdate']);
                $resident->setFamilyCardNumber($result['family_card_number']);
                $resident->setFamilyRole($result['family_role']);

                return $resident;
            }, $results);

            return $residents ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch resident records from database.');
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
                throw new NotFoundException('Resident record data not found.');
            }

            $resident = new Resident();
            $resident->setId($result['id']);
            $resident->setIdentityNumber($result['identity_number']);
            $resident->setFullname($result['fullname']);
            $resident->setGender($result['gender']);
            $resident->setBirthplace($result['birthplace']);
            $resident->setBirthdate($result['birthdate']);
            $resident->setReligion($result['religion']);
            $resident->setEducation($result['education']);
            $resident->setOccupation($result['occupation']);
            $resident->setFamilyRole($result['family_role']);
            $resident->setMaritalStatus($result['marital_status']);
            $resident->setFamilyCardNumber($result['family_card_number']);
            $resident->setCreatedAt($result['created_at']);
            $resident->setUpdatedAt($result['updated_at']);

            return $resident;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to fetch a resident record from database.');
        }
    }

    public function isIdentityNumberTaken(string $identityNumber)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT identity_number FROM residents WHERE identity_number = :identity_number");

            $stmt->execute([
                ":identity_number" => $identityNumber
            ]);

            return $stmt->fetchColumn() !== false;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to check an identity number from database.');
        }
    }

    public function isIdentityNumberTakenByOther(string $identityNumber, int $excludeId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT identity_number FROM residents WHERE identity_number = :identity_number AND id != :exclude_id");

            $stmt->execute([
                ":identity_number" => $identityNumber,
                ":exclude_id" => $excludeId
            ]);

            return $stmt->fetchColumn() !== false;
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to check an identity number from database.');
        }
    }

    public function save(Resident $resident)
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO residents(identity_number, fullname, gender, birthplace_id, birthdate, religion_id, education_id, occupation_id, family_role_id, marital_status, family_card_number) 
                VALUES (:identity_number, :fullname, :gender, :birthplace_id, :birthdate, :religion_id, :education_id, :occupation_id, :family_role_id, :marital_status, :family_card_number)"
            );

            $stmt->execute([
                ":identity_number" => $resident->getIdentityNumber(),
                ":fullname" => $resident->getFullname(),
                ":gender" => $resident->getGender(),
                ":birthplace_id" => $resident->getBirthplaceId(),
                ":birthdate" => $resident->getBirthdate(),
                ":religion_id" => $resident->getReligionId(),
                ":education_id" => $resident->getEducationId(),
                ":occupation_id" => $resident->getOccupationId(),
                ":family_role_id" => $resident->getFamilyRoleId(),
                ":marital_status" => $resident->getMaritalStatus(),
                ":family_card_number" => $resident->getFamilyCardNumber()
            ]);
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to insert a resident record to database.');
        }
    }

    public function update(Resident $resident)
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
                ":identity_number" => $resident->getIdentityNumber(),
                ":fullname" => $resident->getFullname(),
                ":gender" => $resident->getGender(),
                ":birthplace_id" => $resident->getBirthplaceId(),
                ":birthdate" => $resident->getBirthdate(),
                ":religion_id" => $resident->getReligionId(),
                ":education_id" => $resident->getEducationId(),
                ":occupation_id" => $resident->getOccupationId(),
                ":family_role_id" => $resident->getFamilyRoleId(),
                ":marital_status" => $resident->getMaritalStatus(),
                ":family_card_number" => $resident->getFamilyCardNumber(),
                ":id" => $resident->getId()
            ]);

            if ($stmt->rowCount() === 0) {
                throw new NotFoundException("Resident not found.");
            }
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to update a resident record to database.');
        }
    }

    public function delete(int $id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM residents WHERE id = :id");

            $stmt->execute([
                ":id" => $id,
            ]);

            if ($stmt->rowCount() === 0) {
                throw new NotFoundException("Resident record not found.");
            }
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to delete a resident record from database.');
        }
    }
}