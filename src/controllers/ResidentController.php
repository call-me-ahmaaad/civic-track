<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Exceptions\DatabaseException;
use App\Repositories\ResidentRepository;

class ResidentController
{
    private ResidentRepository $residentRepository;

    public function __construct(ResidentRepository $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }

    public function index()
    {
        session_start();

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
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        require 'views/residents/create.php';
    }

    public function store()
    {
        session_start();

        $identityNumber = $_POST['identity-number'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $birthplaceId = $_POST['birthplace'];
        $birthdate = $_POST['birthdate'];
        $religionId = $_POST['religion'];
        $educationLevelId = $_POST['education-level'];
        $occupationId = $_POST['occupation'];
        $familyRoleId = $_POST['family-role'];
        $maritalStatus = $_POST['marital-status'];
        $familyId = $_POST['family-id'];

        try {
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
        }
    }

    public function edit()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_GET['id'];

        try {
            $family = $this->residentRepository->findById($id);

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
        session_start();

        $id = $_POST['id'];
        $identityNumber = $_POST['identity-number'];
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $birthplaceId = $_POST['birthplace'];
        $birthdate = $_POST['birthdate'];
        $religionId = $_POST['religion'];
        $educationLevelId = $_POST['education-level'];
        $occupationId = $_POST['occupation'];
        $familyRoleId = $_POST['family-role'];
        $maritalStatus = $_POST['marital-status'];
        $familyId = $_POST['family-id'];

        try {
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
        }
    }

    public function delete()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_GET['id'];

        try {
            $family = $this->residentRepository->findById($id);

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
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_POST['id'];

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