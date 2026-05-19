<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, DatabaseException, ValidationException};
use App\Repositories\ResidentRepository;
use App\Services\Validators\ResidentValidator;

class ResidentController
{
    private ResidentRepository $residentRepository;
    private ResidentValidator $residentValidator;

    public function __construct(ResidentRepository $residentRepository, ResidentValidator $residentValidator)
    {
        $this->residentRepository = $residentRepository;
        $this->residentValidator = $residentValidator;
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $residents = $this->residentRepository->findAll();

            require 'views/residents/index.php';
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

        require 'views/residents/create.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $identityNumber = $_POST['identity-number'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $birthplaceId = (int) $_POST['birthplace'];
        $birthdate = $_POST['birthdate'];
        $religionId = (int) $_POST['religion'];
        $educationLevelId = (int) $_POST['education-level'];
        $occupationId = (int) $_POST['occupation'];
        $familyRoleId = (int) $_POST['family-role'];
        $maritalStatus = $_POST['marital-status'];
        $familyId = $_POST['family-id'];

        try {
            $this->residentValidator->validation(
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationLevelId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyId
            );

            $this->residentRepository->save(
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationLevelId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyId
            );

            $_SESSION['success'] = "Successfully inserted a new resident. Resident: {$identityNumber}";

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents/create');
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

        try {
            $resident = $this->residentRepository->findById($id);

            require 'views/residents/edit.php';
        } catch (NotFoundException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
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
        $identityNumber = $_POST['identity-number'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $birthplaceId = (int) $_POST['birthplace'];
        $birthdate = $_POST['birthdate'];
        $religionId = (int) $_POST['religion'];
        $educationLevelId = (int) $_POST['education-level'];
        $occupationId = (int) $_POST['occupation'];
        $familyRoleId = (int) $_POST['family-role'];
        $maritalStatus = $_POST['marital-status'];
        $familyId = $_POST['family-id'];

        try {
            $this->residentValidator->validation(
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationLevelId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyId
            );

            $this->residentRepository->update(
                $id,
                $identityNumber,
                $fullname,
                $gender,
                $birthplaceId,
                $birthdate,
                $religionId,
                $educationLevelId,
                $occupationId,
                $familyRoleId,
                $maritalStatus,
                $familyId
            );

            $_SESSION['success'] = "Successfully updated a resident data. Resident: {$identityNumber}";

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents/edit');
            exit();
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_GET['id'];

        try {
            $resident = $this->residentRepository->findById($id);

            require 'views/residents/delete.php';
        } catch (NotFoundException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
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
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }
}