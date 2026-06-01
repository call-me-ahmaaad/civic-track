<?php

use App\Controllers\{AuthController, DashboardController, FamilyController, ResidentController};
use App\Repositories\{FamilyRepository, ReferenceRepository, ResidentRepository, StatisticRepository, UserRepository};
use App\Services\{DashboardService, FamilyService, ResidentService};
use App\Services\Validators\{FamilyValidator, ResidentValidator};

$userRepository = new UserRepository($pdo);
$familyRepository = new FamilyRepository($pdo);
$residentRepository = new ResidentRepository($pdo);
$statisticRepository = new StatisticRepository($pdo);
$referenceRepository = new ReferenceRepository($pdo);

$familyValidator = new FamilyValidator($familyRepository);
$residentValidator = new ResidentValidator($referenceRepository, $residentRepository, $familyRepository);

$familyService = new FamilyService($familyRepository, $residentRepository, $familyValidator);
$residentService = new ResidentService($residentRepository, $residentValidator, $referenceRepository);
$dashboardService = new DashboardService($statisticRepository);

$auth = new AuthController($userRepository);
$family = new FamilyController($familyService);
$resident = new ResidentController($residentService);
$dashboard = new DashboardController($dashboardService);