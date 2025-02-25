<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DirectorController;
use App\Controllers\MovieController;

$router = new Router();
$router->loadRoutes();

$router->get('/', [AuthController::class, 'index']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/movies', [MovieController::class, 'index']);
$router->get('/movies/{id}', [MovieController::class, 'show']);
$router->post('/movies/create', [MovieController::class, 'create']);
$router->get('/movies/edit/{id}', [MovieController::class, 'edit']);
$router->post('/movies/update/{id}', [MovieController::class, 'update']);
$router->delete('/movies/delete/{id}', [MovieController::class, 'delete']);

$router->get('/directors', [DirectorController::class, 'index']);
$router->get('/directors/{id}', [DirectorController::class, 'show']);
$router->post('/directors/create', [DirectorController::class, 'create']);
$router->get('/directors/edit/{id}', [DirectorController::class, 'edit']);
$router->post('/directors/update/{id}', [DirectorController::class, 'update']);
$router->delete('/directors/delete/{id}', [DirectorController::class, 'delete']);
