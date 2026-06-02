<?php

namespace App\Services;

use App\Repositories\StatisticRepository;
use Carbon\Carbon;

class DashboardService
{
    private StatisticRepository $statisticRepository;

    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    public function getDashboardData(): array
    {
        return [
            'total_family' => $this->statisticRepository->getTotalFamily(),
            'total_resident' => $this->statisticRepository->getTotalResident(),
            'total_each_gender' => $this->statisticRepository->getTotalEachGender(),
            'total_each_religion' => $this->statisticRepository->getTotalEachReligion(),
            'total_each_occupation' => $this->statisticRepository->getTotalEachOccupation(),
            'total_each_education' => $this->statisticRepository->getTotalEachEducation(),
            'total_each_age' => $this->getTotalEachAge($this->statisticRepository->getBirthdates()),
        ];
    }

    private function getAge(string $birthdate): int
    {
        return Carbon::parse($birthdate)->age;
    }

    private function getAgeCategory($age): string
    {
        return match (true) {
            $age >= 60 => 'Elderly',
            $age >= 18 => 'Adult',
            $age >= 12 => 'Adolescent',
            $age >= 5 => 'Children',
            $age >= 2 => 'Toddler',
            default => 'Infant'
        };
    }

    private function getTotalEachAge(array $birthdates): array
    {
        $results = [
            'Elderly' => 0,
            'Adult' => 0,
            'Adolescent' => 0,
            'Children' => 0,
            'Toddler' => 0,
            'Infant' => 0
        ];

        $ageCategories = array_map(function ($birthdate) {
            $age = $this->getAge($birthdate);
            return $this->getAgeCategory($age);
        }, $birthdates);

        foreach ($ageCategories as $ageCategory) {
            $results[$ageCategory]++;
        }

        return $results;
    }
}