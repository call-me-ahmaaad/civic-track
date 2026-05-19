<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, DatabaseException, ValidationException};
use App\Repositories\FamilyRepository;
use App\Services\Validators\FamilyValidator;

class FamilyController
{
    private FamilyRepository $familyRepository;
    private FamilyValidator $familyValidator;

    public function __construct(FamilyRepository $familyRepository, FamilyValidator $familyValidator)
    {
        $this->familyRepository = $familyRepository;
        $this->familyValidator = $familyValidator;
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $families = $this->familyRepository->findAll();

            require 'views/families/index.php';
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

        require 'views/families/create.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $familyId = $_POST['family-id'];
        $address = $_POST['address'];
        $neighborhoodUnit = $_POST['neighborhood-unit'];
        $communityUnit = $_POST['community-unit'];

        try {
            $this->familyValidator->validation($familyId, $address, $neighborhoodUnit, $communityUnit);

            $this->familyRepository->save($familyId, $address, $neighborhoodUnit, $communityUnit);

            $_SESSION['success'] = "Successfully inserted a new family. Family: {$familyId}";

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families/create');
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
            $family = $this->familyRepository->findById($id);

            require 'views/families/edit.php';
        } catch (NotFoundException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families');
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
        $familyId = $_POST['family-id'];
        $address = $_POST['address'];
        $neighborhoodUnit = $_POST['neighborhood-unit'];
        $communityUnit = $_POST['community-unit'];

        try {
            $this->familyValidator->validation($familyId, $address, $neighborhoodUnit, $communityUnit);

            $this->familyRepository->update($id, $familyId, $address, $neighborhoodUnit, $communityUnit);

            $_SESSION['success'] = "Successfully updated a family data. Family: {$familyId}";

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families/edit');
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
            $family = $this->familyRepository->findById($id);

            require 'views/families/delete.php';
        } catch (NotFoundException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families');
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
            $this->familyRepository->delete($id);

            $_SESSION['success'] = "Successfully deleted a family data";

            header('Location: /families');
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }
}