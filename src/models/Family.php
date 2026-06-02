<?php

namespace App\Models;

use App\Exceptions\ValidationException;

class Family
{
    private int $id;
    private string $familyCardNumber;
    private string $address;
    private string $neighborhoodUnit;
    private string $communityUnit;
    private string $createdAt;
    private string $updatedAt;

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function setAddress(string $address): void
    {
        if ($address === '') {
            throw new ValidationException("Address cannot be empty");
        }

        $this->address = $address;
    }

    public function setNeighborhoodUnit(string $neighborhoodUnit): void
    {
        if ($neighborhoodUnit === '') {
            throw new ValidationException("Neighborhood Unit cannot be empty");
        }

        if (!preg_match('/^\d{3,10}$/', $neighborhoodUnit)) {
            throw new ValidationException("Neighborhood Unit must consist of 3 to 10 digits");
        }

        $this->neighborhoodUnit = $neighborhoodUnit;
    }

    public function setCommunityUnit(string $communityUnit): void
    {
        if ($communityUnit === '') {
            throw new ValidationException("Community Unit cannot be empty");
        }

        if (!preg_match('/^\d{3,10}$/', $communityUnit)) {
            throw new ValidationException("Community Unit must consist of 3 to 10 digits");
        }

        $this->communityUnit = $communityUnit;
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

    public function getFamilyCardNumber(): string
    {
        return $this->familyCardNumber;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getNeighborhoodUnit(): string
    {
        return $this->neighborhoodUnit;
    }

    public function getCommunityUnit(): string
    {
        return $this->communityUnit;
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