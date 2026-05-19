<?php

use App\Helpers\Database;
use App\Controllers\{AuthController, DashboardController, FamilyController, ResidentController};
use App\Repositories\{UserRepository, FamilyRepository, ResidentRepository, StatisticRepository, ReferenceRepository};
use App\Services\AgeService;
use App\Services\Validators\{FamilyValidator, ResidentValidator};

$config = require __DIR__ . '/config/database.php';
$db = new Database($config);
$pdo = $db->connect();

$auth = new AuthController(new UserRepository($pdo));
$family = new FamilyController(new FamilyRepository($pdo), new FamilyValidator());
$resident = new ResidentController(new ResidentRepository($pdo), new ResidentValidator(new ReferenceRepository($pdo)));
$dashboard = new DashboardController(new StatisticRepository($pdo), new AgeService());