<?php

namespace App\Services\Validators;

use App\Exceptions\ValidationException;

class FamilyValidator
{
    public function validation(string $familyId, string $address, string $neighborhoodUnit, string $communityUnit)
    {
        if (empty($familyId)) {
            throw new ValidationException('Family ID cannot be empty');
        } else if (strlen($familyId) !== 16) {
            throw new ValidationException('Family ID must have a length of 16 numbers');
        }

        if (empty($address)) {
            throw new ValidationException('Address cannot be empty');
        }

        if (empty($neighborhoodUnit)) {
            throw new ValidationException('Neighborhood unit cannot be empty');
        } else if (strlen($neighborhoodUnit) < 3 || strlen($neighborhoodUnit) > 10) {
            throw new ValidationException('Neighborhood unit must have a minimum of 3 numbers & maximum length of 10 numbers');
        }

        if (empty($communityUnit)) {
            throw new ValidationException('Community unit cannot be empty');
        } else if (strlen($communityUnit) < 3 || strlen($communityUnit) > 10) {
            throw new ValidationException('Community unit must have a length minimum of 3 numbers & maximum of 10 numbers');
        }
    }
}