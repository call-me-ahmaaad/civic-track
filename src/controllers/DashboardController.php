<?php

namespace App\Controllers;

use App\Repositories\StatisticRepository;
use App\Exceptions\DatabaseException;

class DashboardController
{
    private StatisticRepository $statisticRepository;

    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
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

            require 'views/dashboard/index.php';
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }
}