<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DirectorController;
use App\Controllers\MovieController;

$router = new Router();

$router->get('/', [AuthController::class, 'index']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/movies', [MovieController::class, 'index']);
$router->get('/movies/show', [MovieController::class, 'show']);
$router->post('/movies/create', [MovieController::class, 'create']);
$router->put('/movies/update', [MovieController::class, 'update']);
$router->delete('/movies/delete', [MovieController::class, 'delete']);

$router->get('/directors', [DirectorController::class, 'index']);
$router->get('/directors/show', [DirectorController::class, 'show']);
$router->post('/directors/create', [DirectorController::class, 'create']);
$router->put('/directors/update', [DirectorController::class, 'update']);
$router->delete('/directors/delete', [DirectorController::class, 'delete']);
