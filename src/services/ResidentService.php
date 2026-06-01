<?php

namespace App\Services;

use App\Exceptions\ValidationException;
use App\Models\Resident;
use App\Repositories\ReferenceRepository;
use App\Repositories\ResidentRepository;
use App\Services\Validators\ResidentValidator;

class ResidentService
{
    private ResidentRepository $residentRepository;
    private ResidentValidator $residentValidator;
    private ReferenceRepository $referenceRepository;

    public function __construct(ResidentRepository $residentRepository, ResidentValidator $residentValidator, ReferenceRepository $referenceRepository)
    {
        $this->residentRepository = $residentRepository;
        $this->residentValidator = $residentValidator;
        $this->referenceRepository = $referenceRepository;
    }

    public function getAllResidents()
    {
        return $this->residentRepository->findAll();
    }

    public function getResidentById(int $id)
    {
        return $this->residentRepository->findById($id);
    }

    public function getDropdownValues()
    {
        return [
            "cities" => $this->referenceRepository->getCities(),
            "religions" => $this->referenceRepository->getReligions(),
            "educations" => $this->referenceRepository->getEducations(),
            "occupations" => $this->referenceRepository->getOccupations(),
            "family_roles" => $this->referenceRepository->getFamilyRoles()
        ];
    }

    public function createResident(array $data)
    {
        $this->residentValidator->validateUniqueIdentityNumber($data['identity_number']);

        $resident = new Resident();
        $resident->setIdentityNumber($data['identity_number']);
        $resident->setFullname($data['fullname']);
        $resident->setGender($data['gender']);
        $resident->setBirthplaceId($data['birthplace_id']);
        $resident->setBirthdate($data['birthdate']);
        $resident->setReligionId($data['religion_id']);
        $resident->setEducationId($data['education_id']);
        $resident->setOccupationId($data['occupation_id']);
        $resident->setFamilyRoleId($data['family_role_id']);
        $resident->setMaritalStatus($data['marital_status']);
        $resident->setFamilyCardNumber($data['family_card_number']);

        $this->residentRepository->save($resident);
    }

    public function updateResident(array $data)
    {
        if ($data['id'] <= 0) {
            throw new ValidationException("Invalid resident ID.");
        }

        $this->residentValidator->validateUniqueUpdateIdentityNumber($data['identity_number'], $data['id']);

        $resident = new Resident();
        $resident->setId($data['id']);
        $resident->setIdentityNumber($data['identity_number']);
        $resident->setFullname($data['fullname']);
        $resident->setGender($data['gender']);
        $resident->setBirthplaceId($data['birthplace_id']);
        $resident->setBirthdate($data['birthdate']);
        $resident->setReligionId($data['religion_id']);
        $resident->setEducationId($data['education_id']);
        $resident->setOccupationId($data['occupation_id']);
        $resident->setFamilyRoleId($data['family_role_id']);
        $resident->setMaritalStatus($data['marital_status']);
        $resident->setFamilyCardNumber($data['family_card_number']);

        $this->residentRepository->update($resident);
    }

    public function deleteResident(int $id)
    {
        if ($id <= 0) {
            throw new ValidationException("Invalid resident ID.");
        }

        $this->residentRepository->delete($id);
    }
}