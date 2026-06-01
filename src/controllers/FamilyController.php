<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, DatabaseException, ValidationException};
use App\Services\FamilyService;

class FamilyController
{
    private FamilyService $familyService;

    public function __construct(FamilyService $familyService)
    {
        $this->familyService = $familyService;
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $families = $this->familyService->getAllFamilies();

            require __DIR__ . '/../../views/families/index.php';
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

        require __DIR__ . '/../../views/families/create.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $family = [
            "family_card_number" => trim($_POST['familyCardNumber']),
            "address" => trim($_POST['address']),
            "neighborhood_unit" => trim($_POST['neighborhoodUnit']),
            "community_unit" => trim($_POST['communityUnit'])
        ];

        try {
            $this->familyService->createFamily($family);

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Family Record Created',
                'text' => 'The family record has been created succesfully.'
            ];

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Create Family Record',
                'text' => 'Unable to create the family record. Please try again.'
            ];

            header('Location: /families');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Create Family Record',
                'text' => $error->getMessage()
            ];

            header('Location: /families/create');
            exit();
        }
    }

    public function detail()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_GET['id'];
        $familyCardNumber = trim($_GET['familyCardNumber']);

        try {
            $family = $this->familyService->getFamilyById($id);
            $residents = $this->familyService->getResidentsByFamilyCardNumber($familyCardNumber);

            require __DIR__ . '/../../views/families/detail.php';
        } catch (NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Family Record Not Found',
                'text' => $error->getMessage()
            ];

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Load Family Record',
                'text' => 'Unable to load the family record. Please try again.'
            ];

            header('Location: /families');
            exit();
        }
    }

    public function edit()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = (int) $_GET['id'];

        try {
            $family = $this->familyService->getFamilyById($id);

            require __DIR__ . '/../../views/families/edit.php';
        } catch (NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Family Record Not Found',
                'text' => $error->getMessage()
            ];

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Load Family Record',
                'text' => 'Unable to load the family record. Please try again.'
            ];

            header('Location: /families');
            exit();
        }
    }

    public function update()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $family = [
            "id" => (int) $_POST['id'],
            "family_card_number" => trim($_POST['familyCardNumber']),
            "address" => trim($_POST['address']),
            "neighborhood_unit" => trim($_POST['neighborhoodUnit']),
            "community_unit" => trim($_POST['communityUnit'])
        ];

        try {
            $this->familyService->updateFamily($family);

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Family Record Updated',
                'text' => 'The family record has been updated successfully'
            ];

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Update Family Record',
                'text' => 'Unable to update the family record. Please try again.'
            ];

            header('Location: /families');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Update Family Record',
                'text' => $error->getMessage()
            ];

            header('Location: /families/edit?id=' . $family['id']);
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
            $this->familyService->deleteFamily($id);

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Family Record Deleted',
                'text' => 'The family record has been deleted successfully.'
            ];

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Delete Family Record',
                'text' => 'Unable to delete the family record. Please try again.'
            ];

            header('Location: /families');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Failed to Delete Family Record',
                'text' => $error->getMessage()
            ];

            header('Location: /families');
            exit();
        }
    }
}