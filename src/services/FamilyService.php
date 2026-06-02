<?php

namespace App\Services;

use App\Models\Family;
use App\Repositories\{FamilyRepository, ResidentRepository};
use App\Services\Validators\FamilyValidator;
use App\Exceptions\{ValidationException, NotFoundException};

class FamilyService
{
    private FamilyRepository $familyRepository;
    private ResidentRepository $residentRepository;
    private FamilyValidator $familyValidator;

    public function __construct(FamilyRepository $familyRepository, ResidentRepository $residentRepository, FamilyValidator $familyValidator)
    {
        $this->familyRepository = $familyRepository;
        $this->residentRepository = $residentRepository;
        $this->familyValidator = $familyValidator;
    }

    public function getAllFamilies(): array
    {
        return $this->familyRepository->findAll();
    }

    public function getFamilyById(int $id): Family
    {
        return $this->familyRepository->findById($id);
    }

    public function getResidentsByFamilyCardNumber(string $familyCardNumber): array
    {
        return $this->residentRepository->findByFamilyCardNumber($familyCardNumber);
    }

    public function createFamily(array $data): void
    {
        $this->familyValidator->validateUniqueFamilyCardNumber($data['family_card_number']);

        $family = new Family();
        $family->setFamilyCardNumber($data['family_card_number']);
        $family->setAddress($data['address']);
        $family->setNeighborhoodUnit($data['neighborhood_unit']);
        $family->setCommunityUnit($data['community_unit']);

        $this->familyRepository->save($family);
    }

    public function updateFamily(array $data): void
    {
        if ($data['id'] <= 0) {
            throw new ValidationException("Invalid family ID.");
        }

        if (!$this->familyRepository->isIdExist($data['id'])) {
            throw new NotFoundException("Family record not found.");
        }

        $this->familyValidator->validateUniqueUpdateFamilyCardNumber($data['family_card_number'], $data['id']);

        $family = new Family();
        $family->setId($data['id']);
        $family->setFamilyCardNumber($data['family_card_number']);
        $family->setAddress($data['address']);
        $family->setNeighborhoodUnit($data['neighborhood_unit']);
        $family->setCommunityUnit($data['community_unit']);

        $this->familyRepository->update($family);
    }

    public function deleteFamily(int $id): void
    {
        if ($id <= 0) {
            throw new ValidationException("Invalid family ID.");
        }

        if (!$this->familyRepository->isIdExist($id)) {
            throw new NotFoundException("Family record not found.");
        }

        $this->familyRepository->delete($id);
    }
}