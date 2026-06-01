<?php

namespace App\Services\Validators;

use App\Exceptions\ValidationException;
use App\Repositories\FamilyRepository;

class FamilyValidator
{
    private FamilyRepository $familyRepository;

    public function __construct(FamilyRepository $familyRepository)
    {
        $this->familyRepository = $familyRepository;
    }

    public function validateUniqueFamilyCardNumber(string $familyCardNumber)
    {
        if ($this->familyRepository->isFamilyCardNumberTaken($familyCardNumber)) {
            throw new ValidationException("Family Card Number is already in use.");
        }
    }

    public function validateUniqueUpdateFamilyCardNumber(string $familyCardNumber, int $excludeId)
    {
        if ($this->familyRepository->isFamilyCardNumberTakenByOther($familyCardNumber, $excludeId)) {
            throw new ValidationException("Family Card Number is already in use.");
        }
    }
}