<?php

namespace App\Models;

class Family
{
    private ?int $id = null;
    private string $familyId;
    private string $address;
    private string $neighborhoodUnit;
    private string $communityUnit;

    public function __construct(?int $id, string $familyId, string $address, string $neighborhoodUnit, string $communityUnit)
    {
        $this->id = $id;
        $this->familyId = $familyId;
        $this->address = $address;
        $this->neighborhoodUnit = $neighborhoodUnit;
        $this->communityUnit = $communityUnit;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFamilyId()
    {
        return $this->familyId;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getNeighborhoodUnit()
    {
        return $this->neighborhoodUnit;
    }

    public function getCommunityUnit()
    {
        return $this->communityUnit;
    }
}