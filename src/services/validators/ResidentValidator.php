<?php

namespace App\Services\Validators;

use App\Exceptions\ValidationException;
use App\Repositories\FamilyRepository;
use App\Repositories\ReferenceRepository;
use App\Repositories\ResidentRepository;

class ResidentValidator
{
    private ReferenceRepository $referenceRepository;
    private ResidentRepository $residentRepository;
    private FamilyRepository $familyRepository;

    public function __construct(ReferenceRepository $referenceRepository, ResidentRepository $residentRepository, FamilyRepository $familyRepository)
    {
        $this->referenceRepository = $referenceRepository;
        $this->residentRepository = $residentRepository;
        $this->familyRepository = $familyRepository;
    }

    public function validateUniqueIdentityNumber(string $identityNumber)
    {
        if ($this->residentRepository->isIdentityNumberTaken($identityNumber)) {
            throw new ValidationException("Identity Number is already in use.");
        }
    }

    public function validateUniqueUpdateIdentityNumber(string $identityNumber, int $excludeId)
    {
        if ($this->residentRepository->isIdentityNumberTakenByOther($identityNumber, $excludeId)) {
            throw new ValidationException("Identity Number is already in use.");
        }
    }

    public function validateRegisteredFamilyCardNumber(string $familyCardNumber)
    {
        if (!$this->familyRepository->isFamilyCardNumberTaken($familyCardNumber)) {
            throw new ValidationException("Family Card Number isn't registered in families data.");
        }
    }

    public function validateBirthplaceOption(int $birthplaceId)
    {
        if (!$this->referenceRepository->exists('cities', $birthplaceId)) {
            throw new ValidationException("Selected birthplace is invalid.");
        }
    }

    public function validateReligionOption(int $religionId)
    {
        if (!$this->referenceRepository->exists('religions', $religionId)) {
            throw new ValidationException("Selected religion is invalid.");
        }
    }

    public function validateEducationOption(int $educationId)
    {
        if (!$this->referenceRepository->exists('educations', $educationId)) {
            throw new ValidationException("Selected education is invalid.");
        }
    }

    public function validateOccupationOption(int $occupationId)
    {
        if (!$this->referenceRepository->exists('occupations', $occupationId)) {
            throw new ValidationException("Selected occupation is invalid.");
        }
    }

    public function validateFamilyRoleOption(int $familyRoleId)
    {
        if (!$this->referenceRepository->exists('family_roles', $familyRoleId)) {
            throw new ValidationException("Selected family role is invalid.");
        }
    }
}