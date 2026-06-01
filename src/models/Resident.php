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

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setIdentityNumber(string $identityNumber)
    {
        if ($identityNumber === '') {
            throw new ValidationException("Identity Number cannot be empty");
        }

        if (!preg_match('/^\d{16}$/', $identityNumber)) {
            throw new ValidationException("Identity Number must consist of 16 digits");
        }

        $this->identityNumber = $identityNumber;
    }

    public function setFamilyId(int $familyId)
    {
        $this->familyId = $familyId;
    }

    public function setFamilyCardNumber(string $familyCardNumber)
    {
        if ($familyCardNumber === '') {
            throw new ValidationException("Family Card Number cannot be empty");
        }

        if (!preg_match('/^\d{16}$/', $familyCardNumber)) {
            throw new ValidationException("Family Card Number must consist of 16 digits");
        }

        $this->familyCardNumber = $familyCardNumber;
    }

    public function setFullname(string $fullname)
    {
        if ($fullname === '') {
            throw new ValidationException("Fullname cannot be empty");
        }

        if (!preg_match('/^[a-zA-Z\s\'\-\.]+$/', $fullname)) {
            throw new ValidationException("Fullname contains invalid characters");
        }

        $this->fullname = $fullname;
    }

    public function setGender(string $gender)
    {
        if ($gender === '') {
            throw new ValidationException("Gender cannot be empty");
        }

        if (!in_array($gender, $this->genders)) {
            throw new ValidationException("Invalid gender option");
        }

        $this->gender = $gender;
    }

    public function setBirthplaceId(int $birthplaceId)
    {
        $this->birthplaceId = $birthplaceId;
    }

    public function setBirthplace(string $birthplace)
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

    public function setReligionId(int $religionId)
    {
        $this->religionId = $religionId;
    }

    public function setReligion(string $religion)
    {
        $this->religion = $religion;
    }

    public function setEducationId(int $educationId)
    {
        $this->educationId = $educationId;
    }

    public function setEducation(string $education)
    {
        $this->education = $education;
    }

    public function setOccupationId(int $occupationId)
    {
        $this->occupationId = $occupationId;
    }

    public function setOccupation(string $occupation)
    {
        $this->occupation = $occupation;
    }

    public function setFamilyRoleId(int $familyRoleId)
    {
        $this->familyRoleId = $familyRoleId;
    }

    public function setFamilyRole(string $familyRole)
    {
        $this->familyRole = $familyRole;
    }

    public function setMaritalStatus(string $maritalStatus)
    {
        if ($maritalStatus === '') {
            throw new ValidationException("Marital Status cannot be empty");
        }

        if (!in_array($maritalStatus, $this->maritalStatuses)) {
            throw new ValidationException("Invalid Marital Status option");
        }

        $this->maritalStatus = $maritalStatus;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdentityNumber()
    {
        return $this->identityNumber;
    }

    public function getFamilyId()
    {
        return $this->familyId;
    }

    public function getFamilyCardNumber()
    {
        return $this->familyCardNumber;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getBirthplaceId()
    {
        return $this->birthplaceId;
    }

    public function getBirthplace()
    {
        return $this->birthplace;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getReligionId()
    {
        return $this->religionId;
    }

    public function getReligion()
    {
        return $this->religion;
    }

    public function getEducationId()
    {
        return $this->educationId;
    }

    public function getEducation()
    {
        return $this->education;
    }

    public function getOccupationId()
    {
        return $this->occupationId;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function getFamilyRoleId()
    {
        return $this->familyRoleId;
    }

    public function getFamilyRole()
    {
        return $this->familyRole;
    }

    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}