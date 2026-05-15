<?php

namespace App\Models;

class Resident
{
    private ?int $id = null;
    private string $identityNumber;
    private string $fullname;
    private string $gender;
    private int $birthplaceId;
    private string $birthdate;
    private int $religionId;
    private int $educationLevelId;
    private int $occupationId;
    private int $familyRoleId;
    private string $maritalStatus;
    private string $familyId;

    public function __construct(
        ?int $id,
        string $identityNumber,
        string $fullname,
        string $gender,
        int $birthplaceId,
        string $birthdate,
        int $religionId,
        int $educationLevelId,
        int $occupationId,
        int $familyRoleId,
        string $maritalStatus,
        string $familyId
    ) {
        $this->id = $id;
        $this->identityNumber = $identityNumber;
        $this->fullname = $fullname;
        $this->gender = $gender;
        $this->birthplaceId = $birthplaceId;
        $this->birthdate = $birthdate;
        $this->religionId = $religionId;
        $this->educationLevelId = $educationLevelId;
        $this->occupationId = $occupationId;
        $this->familyRoleId = $familyRoleId;
        $this->maritalStatus = $maritalStatus;
        $this->familyId = $familyId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdentityNumber()
    {
        return $this->identityNumber;
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

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getReligionId()
    {
        return $this->religionId;
    }

    public function getEducationLevelId()
    {
        return $this->educationLevelId;
    }

    public function getOccupationId()
    {
        return $this->occupationId;
    }

    public function getFamilyRoleId()
    {
        return $this->familyRoleId;
    }

    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    public function getFamilyId()
    {
        return $this->familyId;
    }
}