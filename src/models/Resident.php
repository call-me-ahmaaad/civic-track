<?php

namespace App\Models;

use App\Exceptions\ValidationException;
use Carbon\Carbon;

class Resident
{
    private int $id;
    private string $identityNumber;
    private int $familyId;
    private string $familyCardNumber;
    private string $fullname;
    private string $gender;
    private array $genders = ["Male", "Female"];
    private int $birthplaceId;
    private string $birthplace;
    private string $birthdate;
    private int $religionId;
    private string $religion;
    private int $educationId;
    private string $education;
    private int $occupationId;
    private string $occupation;
    private int $familyRoleId;
    private string $familyRole;
    private string $maritalStatus;
    private array $maritalStatuses = ["Single", "Married", "Divorced", "Widowed"];
    private string $createdAt;
    private string $updatedAt;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setIdentityNumber(string $identityNumber): void
    {
        if ($identityNumber === '') {
            throw new ValidationException("Identity Number cannot be empty");
        }

        if (!preg_match('/^\d{16}$/', $identityNumber)) {
            throw new ValidationException("Identity Number must consist of 16 digits");
        }

        $this->identityNumber = $identityNumber;
    }

    public function setFamilyId(int $familyId): void
    {
        $this->familyId = $familyId;
    }

    public function setFamilyCardNumber(string $familyCardNumber): void
    {
        if ($familyCardNumber === '') {
            throw new ValidationException("Family Card Number cannot be empty");
        }

        if (!preg_match('/^\d{16}$/', $familyCardNumber)) {
            throw new ValidationException("Family Card Number must consist of 16 digits");
        }

        $this->familyCardNumber = $familyCardNumber;
    }

    public function setFullname(string $fullname): void
    {
        if ($fullname === '') {
            throw new ValidationException("Fullname cannot be empty");
        }

        if (!preg_match('/^[a-zA-Z\s\'\-\.]+$/', $fullname)) {
            throw new ValidationException("Fullname contains invalid characters");
        }

        $this->fullname = $fullname;
    }

    public function setGender(string $gender): void
    {
        if ($gender === '') {
            throw new ValidationException("Gender cannot be empty");
        }

        if (!in_array($gender, $this->genders)) {
            throw new ValidationException("Invalid gender option");
        }

        $this->gender = $gender;
    }

    public function setBirthplaceId(int $birthplaceId): void
    {
        $this->birthplaceId = $birthplaceId;
    }

    public function setBirthplace(string $birthplace): void
    {
        $this->birthplace = $birthplace;
    }

    public function setBirthdate(string $birthdate): void
    {
        if ($birthdate === '') {
            throw new ValidationException("Birthdate cannot be empty");
        }

        if (Carbon::parse($birthdate)->isFuture()) {
            throw new ValidationException("Birthdate cannot be in the future");
        }

        $this->birthdate = $birthdate;
    }

    public function setReligionId(int $religionId): void
    {
        $this->religionId = $religionId;
    }

    public function setReligion(string $religion): void
    {
        $this->religion = $religion;
    }

    public function setEducationId(int $educationId): void
    {
        $this->educationId = $educationId;
    }

    public function setEducation(string $education): void
    {
        $this->education = $education;
    }

    public function setOccupationId(int $occupationId): void
    {
        $this->occupationId = $occupationId;
    }

    public function setOccupation(string $occupation): void
    {
        $this->occupation = $occupation;
    }

    public function setFamilyRoleId(int $familyRoleId): void
    {
        $this->familyRoleId = $familyRoleId;
    }

    public function setFamilyRole(string $familyRole): void
    {
        $this->familyRole = $familyRole;
    }

    public function setMaritalStatus(string $maritalStatus): void
    {
        if ($maritalStatus === '') {
            throw new ValidationException("Marital Status cannot be empty");
        }

        if (!in_array($maritalStatus, $this->maritalStatuses)) {
            throw new ValidationException("Invalid Marital Status option");
        }

        $this->maritalStatus = $maritalStatus;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdentityNumber(): string
    {
        return $this->identityNumber;
    }

    public function getFamilyId(): int
    {
        return $this->familyId;
    }

    public function getFamilyCardNumber(): string
    {
        return $this->familyCardNumber;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getBirthplaceId(): int
    {
        return $this->birthplaceId;
    }

    public function getBirthplace(): string
    {
        return $this->birthplace;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    public function getReligionId(): int
    {
        return $this->religionId;
    }

    public function getReligion(): string
    {
        return $this->religion;
    }

    public function getEducationId(): int
    {
        return $this->educationId;
    }

    public function getEducation(): string
    {
        return $this->education;
    }

    public function getOccupationId(): int
    {
        return $this->occupationId;
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    public function getFamilyRoleId(): int
    {
        return $this->familyRoleId;
    }

    public function getFamilyRole(): string
    {
        return $this->familyRole;
    }

    public function getMaritalStatus(): string
    {
        return $this->maritalStatus;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}