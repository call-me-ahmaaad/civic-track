<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, DatabaseException, ValidationException};
use App\Repositories\{FamilyRepository, ResidentRepository};
use App\Services\Validators\FamilyValidator;

class FamilyController
{
    private FamilyRepository $familyRepository;
    private FamilyValidator $familyValidator;
    private ResidentRepository $residentRepository;

    public function __construct(FamilyRepository $familyRepository, FamilyValidator $familyValidator, ResidentRepository $residentRepository)
    {
        $this->familyRepository = $familyRepository;
        $this->familyValidator = $familyValidator;
        $this->residentRepository = $residentRepository;
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $families = $this->familyRepository->findAll();

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

        $familyCardNumber = $_POST['familyCardNumber'];
        $address = $_POST['address'];
        $neighborhoodUnit = $_POST['neighborhoodUnit'];
        $communityUnit = $_POST['communityUnit'];

        try {
            $this->familyValidator->validation($familyCardNumber, $address, $neighborhoodUnit, $communityUnit);

            $this->familyRepository->save($familyCardNumber, $address, $neighborhoodUnit, $communityUnit);

            $_SESSION['success'] = "Successfully inserted a new family. Family: {$familyCardNumber}";

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

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

        $id = $_GET['id'];
        $familyCardNumber = $_GET['familyCardNumber'];

        try {
            $family = $this->familyRepository->findById($id);
            $residents = $this->residentRepository->findByFamilyCardNumber($familyCardNumber);

            require __DIR__ . '/../../views/families/detail.php';
        } catch (NotFoundException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

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

        $id = $_GET['id'];

        try {
            $family = $this->familyRepository->findById($id);

            require __DIR__ . '/../../views/families/edit.php';
        } catch (NotFoundException | DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

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

        $id = $_POST['id'];
        $familyCardNumber = $_POST['familyCardNumber'];
        $address = $_POST['address'];
        $neighborhoodUnit = $_POST['neighborhoodUnit'];
        $communityUnit = $_POST['communityUnit'];

        try {
            $this->familyValidator->validation($familyCardNumber, $address, $neighborhoodUnit, $communityUnit);

            $this->familyRepository->update($id, $familyCardNumber, $address, $neighborhoodUnit, $communityUnit);

            $_SESSION['success'] = "Successfully updated a family data.";

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families');
            exit();
        } catch (ValidationException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families/edit?id=' . $id);
            exit();
        }
    }

    public function destroy()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_POST['id'];

        try {
            $this->familyRepository->delete($id);

            $_SESSION['success'] = "Successfully deleted a family data";

            header('Location: /families');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /families');
            exit();
        }
    }
}