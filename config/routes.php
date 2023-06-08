<?php

declare(strict_types=1);

use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Front\HomeController;
use App\Middleware\AdminAuthenticationMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index']);

    $app->group('/admin', function (RouteCollectorProxy $collection) {
        $collection->get('', [DashboardController::class, 'index']);
    })->add(AdminAuthenticationMiddleware::class);

    $app->get('/admin/login', [AuthController::class, 'login']);
    $app->post('/admin/login', [AuthController::class, 'login']);
};