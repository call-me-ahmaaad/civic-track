<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, DatabaseException, ValidationException};
use App\Repositories\{ResidentRepository, ReferenceRepository};
use App\Services\Validators\ResidentValidator;

class ResidentController
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

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $residents = $this->residentRepository->findAll();

            require __DIR__ . '/../../views/residents/index.php';
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }

    public function create()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $cities = $this->referenceRepository->getCities();
        $religions = $this->referenceRepository->getReligions();
        $educations = $this->referenceRepository->getEducations();
        $occupations = $this->referenceRepository->getOccupations();
        $familyRoles = $this->referenceRepository->getFamilyRoles();

        require __DIR__ . '/../../views/residents/create.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $identityNumber = $_POST['identityNumber'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $birthplaceId = (int) $_POST['birthplace'];
        $birthdate = $_POST['birthdate'];
        $religionId = (int) $_POST['religion'];
        $educationId = (int) $_POST['education'];
        $occupationId = (int) $_POST['occupation'];
        $familyRoleId = (int) $_POST['familyRole'];
        $maritalStatus = $_POST['maritalStatus'];
        $familyCardNumber = $_POST['familyCardNumber'];

        try {
            $this->residentValidator->validation(
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyCardNumber
            );

            $this->residentRepository->save(
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyCardNumber
            );

            $_SESSION['success'] = "Successfully inserted a new resident.";

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents/create');
            exit();
        }
    }

    public function detail()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_GET['id'];

        try {
            $resident = $this->residentRepository->findById($id);

            require __DIR__ . '/../../views/residents/detail.php';
        } catch (NotFoundException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        }
    }

    public function edit()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_GET['id'];

        $cities = $this->referenceRepository->getCities();
        $religions = $this->referenceRepository->getReligions();
        $educations = $this->referenceRepository->getEducations();
        $occupations = $this->referenceRepository->getOccupations();
        $familyRoles = $this->referenceRepository->getFamilyRoles();

        try {
            $resident = $this->residentRepository->findById($id);

            require __DIR__ . '/../../views/residents/edit.php';
        } catch (NotFoundException | DatabaseException  $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        }
    }

    public function update()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_POST['id'];
        $identityNumber = $_POST['identityNumber'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $birthplaceId = (int) $_POST['birthplace'];
        $birthdate = $_POST['birthdate'];
        $religionId = (int) $_POST['religion'];
        $educationId = (int) $_POST['education'];
        $occupationId = (int) $_POST['occupation'];
        $familyRoleId = (int) $_POST['familyRole'];
        $maritalStatus = $_POST['maritalStatus'];
        $familyCardNumber = $_POST['familyCardNumber'];

        try {
            $this->residentValidator->validation(
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyCardNumber
            );

            $this->residentRepository->update(
                $id,
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyCardNumber
            );

            $_SESSION['success'] = "Successfully updated a resident data";

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents/edit?id=' . $id);
            exit();
        }
    }

    public function destroy()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_POST['id'];

        try {
            $this->residentRepository->delete($id);

            $_SESSION['success'] = "Successfully deleted a resident data";

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        }
    }
}