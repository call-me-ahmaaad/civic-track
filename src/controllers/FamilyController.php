<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Repositories\FamilyRepository;
use App\Exceptions\DatabaseException;

class FamilyController
{
    private FamilyRepository $familyRepository;

    public function __construct(FamilyRepository $familyRepository)
    {
        $this->familyRepository = $familyRepository;
    }

    public function index()
    {
        session_start();

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
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        require 'views/families/create.php';
    }

    public function store()
    {
        session_start();

        $familyId = $_POST['family-id'];
        $address = $_POST['address'];
        $neighborhoodUnit = $_POST['neighborhood-unit'];
        $communityUnit = $_POST['community-unit'];

        try {
            $this->familyRepository->save($familyId, $address, $neighborhoodUnit, $communityUnit);

            $_SESSION['success'] = "Successfully inserted a new family. Family: {$familyId}";

            header('Location: /families');
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
        session_start();

        $id = $_POST['id'];
        $familyId = $_POST['family-id'];
        $address = $_POST['address'];
        $neighborhoodUnit = $_POST['neighborhood-unit'];
        $communityUnit = $_POST['community-unit'];

        try {
            $this->familyRepository->update($id, $familyId, $address, $neighborhoodUnit, $communityUnit);

            $_SESSION['success'] = "Successfully updated a family data. Family: {$familyId}";

            header('Location: /families');
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
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $id = $_POST['id'];

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