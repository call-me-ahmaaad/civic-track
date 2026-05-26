<?php

namespace App\Services\Validators;

use App\Exceptions\ValidationException;
use App\Repositories\ReferenceRepository;

class ResidentValidator
{
    private ReferenceRepository $referenceRepository;
    private array $genders = ['Male', 'Female'];
    private array $maritalStatuses = ['Single', 'Married', 'Divorced', 'Widowed'];

    public function __construct(ReferenceRepository $referenceRepository)
    {
        $this->referenceRepository = $referenceRepository;
    }

    public function validation(string $identityNumber, string $fullname, string $gender, int $birthplaceId, string $birthdate, int $religionId, int $educationId, int $occupationId, int $familyRoleId, string $maritalStatus, string $familyCardNumber)
    {
        if (empty($identityNumber)) {
            throw new ValidationException('Identity number cannot be empty');
        } else if (strlen($identityNumber) !== 16) {
            throw new ValidationException('Identity number must have a length of 16 numbers');
        }

        if (empty($fullname)) {
            throw new ValidationException('Fullname cannot be empty');
        }

        if (empty($gender)) {
            throw new ValidationException('Gender cannot be empty');
        } else if (!in_array($gender, $this->genders)) {
            throw new ValidationException('Invalid gender option');
        }

        if (empty($birthplaceId)) {
            throw new ValidationException('Birthplace cannot be empty');
        } else if (!$this->referenceRepository->exists('cities', $birthplaceId)) {
            throw new ValidationException('Invalid birthplace option');
        }

        if (empty($birthdate)) {
            throw new ValidationException('Birthdate cannot be empty');
        }

        if (empty($religionId)) {
            throw new ValidationException('Religion cannot be empty');
        } else if (!$this->referenceRepository->exists('religions', $religionId)) {
            throw new ValidationException('Invalid religion option');
        }

        if (empty($educationId)) {
            throw new ValidationException('Education cannot be empty');
        } else if (!$this->referenceRepository->exists('educations', $educationId)) {
            throw new ValidationException('Invalid education level option');
        }

        if (empty($occupationId)) {
            throw new ValidationException('Occupation cannot be empty');
        } else if (!$this->referenceRepository->exists('occupations', $occupationId)) {
            throw new ValidationException('Invalid occupation option');
        }

        if (empty($familyRoleId)) {
            throw new ValidationException('Family role cannot be empty');
        } else if (!$this->referenceRepository->exists('family_roles', $familyRoleId)) {
            throw new ValidationException('Invalid family role option');
        }

        if (empty($maritalStatus)) {
            throw new ValidationException('Marital status cannot be empty');
        } else if (!in_array($maritalStatus, $this->maritalStatuses)) {
            throw new ValidationException('Invalid marital status option');
        }

        if (empty($familyCardNumber)) {
            throw new ValidationException('Family ID cannot be empty');
        } else if (strlen($familyCardNumber) !== 16) {
            throw new ValidationException('Family ID must have a length of 16 numbers');
        }
    }
}