<?php

namespace App\Repositories;

use App\Exceptions\DatabaseException;
use PDO;
use PDOException;

class StatisticRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTotalFamily()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(id) AS total_family FROM families");

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get total of family from database');
        }
    }

    public function getTotalResident()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(id) AS total_resident FROM residents");

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get total of resident from database');
        }
    }

    public function getTotalEachGender()
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS count_male,
                        SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS count_female
                FROM residents"
            );

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get total of each gender from database');
        }
    }

    public function getTotalEachReligion()
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT religions.religion,
                        COUNT(residents.id) AS total
                FROM residents
                INNER JOIN religions ON religions.id = residents.religion_id
                GROUP BY religions.religion"
            );

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get total of each religion from database');
        }
    }

    public function getTotalEachOccupation()
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT occupations.occupation,
                        COUNT(residents.id) AS total
                FROM residents
                INNER JOIN occupations ON occupations.id = residents.occupation_id
                GROUP BY occupations.occupation
                ORDER BY total DESC"
            );

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get total of each occupation from database');
        }
    }

    public function getTotalEachEducationLevel()
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT education_levels.education,
                        COUNT(residents.id) AS total
                FROM residents
                INNER JOIN education_levels ON education_levels.id = residents.education_level_id
                GROUP BY education_levels.education"
            );

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get total of each education level from database');
        }
    }

    public function getBirthdate()
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT birthdate FROM residents"
            );

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

            return $result ?: [];
        } catch (PDOException $error) {
            throw new DatabaseException('Failed to get birthdate from database');
        }
    }
}