<?php

namespace App\Services;

use Carbon\Carbon;

class AgeService
{
    public function getAge(string $birthdate)
    {
        return Carbon::parse($birthdate)->age;
    }

    public function getAgeCategory($age)
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

    public function getTotalEachAge(array $birthdates)
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