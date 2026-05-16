<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Helpers\Database;
use App\Controllers\{AuthController, DashboardController, FamilyController, ResidentController};
use App\Repositories\{UserRepository, FamilyRepository, ResidentRepository, StatisticRepository};
use App\Services\AgeService;

$config = require __DIR__ . '/config/database.php';
$db = new Database($config);
$pdo = $db->connect();

$auth = new AuthController(new UserRepository($pdo));
$family = new FamilyController(new FamilyRepository($pdo));
$resident = new ResidentController(new ResidentRepository($pdo));
$dashboard = new DashboardController(new StatisticRepository($pdo), new AgeService());

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

match (true) {
    // Auth
    $method === 'GET' && $uri === '/login' => $auth->index(),
    $method === 'POST' && $uri === '/login' => $auth->login(),
    $method === 'GET' && $uri === '/logout' => $auth->logout(),

    // Dashboard
    $method === 'GET' && $uri === '/' => $dashboard->index(),

    // Families
    $method === 'GET' && $uri === '/families' => $family->index(),
    $method === 'GET' && $uri === '/families/create' => $family->create(),
    $method === 'POST' && $uri === '/families/store' => $family->store(),
    $method === 'GET' && $uri === '/families/edit' => $family->edit(),
    $method === 'POST' && $uri === '/families/update' => $family->update(),
    $method === 'GET' && $uri === '/families/delete' => $family->delete(),
    $method === 'POST' && $uri === '/families/destroy' => $family->destroy(),

    // Residents
    $method === 'GET' && $uri === '/residents' => $resident->index(),
    $method === 'GET' && $uri === '/residents/create' => $resident->create(),
    $method === 'POST' && $uri === '/residents/store' => $resident->store(),
    $method === 'GET' && $uri === '/residents/edit' => $resident->edit(),
    $method === 'POST' && $uri === '/residents/update' => $resident->update(),
    $method === 'GET' && $uri === '/residents/delete' => $resident->delete(),
    $method === 'POST' && $uri === '/residents/destroy' => $resident->destroy(),

    default => http_response_code(404)
};