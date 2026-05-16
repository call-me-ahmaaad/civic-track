<?php

namespace App\Controllers;

use App\Repositories\StatisticRepository;
use App\Services\AgeService;
use App\Exceptions\DatabaseException;

class DashboardController
{
    private StatisticRepository $statisticRepository;
    private AgeService $ageService;

    public function __construct(StatisticRepository $statisticRepository, AgeService $ageService)
    {
        $this->statisticRepository = $statisticRepository;
        $this->ageService = $ageService;
    }

    public function index()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        try {
            $totalFamily = $this->statisticRepository->getTotalFamily();
            $totalResident = $this->statisticRepository->getTotalResident();
            $totalEachGender = $this->statisticRepository->getTotalEachGender();
            $totalEachReligion = $this->statisticRepository->getTotalEachReligion();
            $totalEachOccupation = $this->statisticRepository->getTotalEachOccupation();
            $totalEachEducationLevel = $this->statisticRepository->getTotalEachEducationLevel();

            $birthdates = $this->statisticRepository->getBirthdate();
            $totalEachAge = $this->ageService->getTotalEachAge($birthdates);

            require 'views/dashboard/index.php';
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }
}