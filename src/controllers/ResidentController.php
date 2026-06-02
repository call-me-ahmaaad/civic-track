<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, DatabaseException, ValidationException};
use App\Services\ResidentService;

class ResidentController
{
    private ResidentService $residentService;

    public function __construct(ResidentService $residentService)
    {
        $this->residentService = $residentService;
    }

    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $residents = $this->residentService->getAllResidents();

            require __DIR__ . '/../../views/residents/index.php';
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }

    public function create(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $dropdown = $this->residentService->getDropdownValues();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Load Resident Form',
                'text' => 'Unable to load the resident creation form. Please try again.'
            ];

            header('Location: /residents');
            exit();
        }

        require __DIR__ . '/../../views/residents/create.php';
    }

    public function store(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $resident = [
            "identity_number" => trim($_POST['identityNumber']),
            "fullname" => trim($_POST['fullname']),
            "gender" => trim($_POST['gender']),
            "birthplace_id" => (int) $_POST['birthplace'],
            "birthdate" => trim($_POST['birthdate']),
            "religion_id" => (int) $_POST['religion'],
            "education_id" => (int) $_POST['education'],
            "occupation_id" => (int) $_POST['occupation'],
            "family_role_id" => (int) $_POST['familyRole'],
            "marital_status" => trim($_POST['maritalStatus']),
            "family_card_number" => trim($_POST['familyCardNumber'])
        ];

        try {
            $this->residentService->createResident($resident);

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Resident Record Created',
                'text' => 'The resident record has been created successfully.'
            ];

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Create Resident Record',
                'text' => 'Unable to create the resident record. Please try again.'
            ];

            header('Location: /residents');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Create Resident Record',
                'text' => $error->getMessage()
            ];

            header('Location: /residents/create');
            exit();
        }
    }

    public function detail(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_GET['id'];

        try {
            $resident = $this->residentService->getResidentById($id);

            require __DIR__ . '/../../views/residents/detail.php';
        } catch (NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Resident Record Not Found',
                'text' => $error->getMessage()
            ];

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Load Resident Record',
                'text' => 'Unable to load the resident record. Please try again.'
            ];

            header('Location: /residents');
            exit();
        }
    }

    public function edit(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_GET['id'];

        try {
            $dropdown = $this->residentService->getDropdownValues();

            $resident = $this->residentService->getResidentById($id);

            require __DIR__ . '/../../views/residents/edit.php';
        } catch (NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Resident Record Not Found',
                'text' => $error->getMessage()
            ];

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Load Resident Record',
                'text' => 'Unable to load the resident record. Please try again.'
            ];

            header('Location: /residents');
            exit();
        }
    }

    public function update(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $resident = [
            "id" => (int) $_POST['id'],
            "identity_number" => trim($_POST['identityNumber']),
            "fullname" => trim($_POST['fullname']),
            "gender" => trim($_POST['gender']),
            "birthplace_id" => (int) $_POST['birthplace'],
            "birthdate" => trim($_POST['birthdate']),
            "religion_id" => (int) $_POST['religion'],
            "education_id" => (int) $_POST['education'],
            "occupation_id" => (int) $_POST['occupation'],
            "family_role_id" => (int) $_POST['familyRole'],
            "marital_status" => trim($_POST['maritalStatus']),
            "family_card_number" => trim($_POST['familyCardNumber'])
        ];

        try {
            $this->residentService->updateResident($resident);

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Resident Record Updated',
                'text' => 'The resident record has been updated successfully.'
            ];

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Update Resident Record',
                'text' => 'Unable to update the resident record. Please try again.'
            ];

            header('Location: /residents');
            exit();
        } catch (ValidationException | NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Update Resident Record',
                'text' => $error->getMessage()
            ];

            header('Location: /residents/edit?id=' . $resident['id']);
            exit();
        }
    }

    public function destroy(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_POST['id'];

        try {
            $this->residentService->deleteResident($id);

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Resident Record Deleted',
                'text' => 'The resident record has been deleted successfully.'
            ];

            header('Location: /residents');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Delete Resident Record',
                'text' => 'Unable to delete the resident record. Please try again.'
            ];

            header('Location: /residents');
            exit();
        } catch (ValidationException | NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Delete Resident Record',
                'text' => $error->getMessage()
            ];

            header('Location: /residents');
            exit();
        }
    }
}