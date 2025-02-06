<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\Controller\AuthController;
use App\Controller\CardController;
use App\Controller\UserController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GlobalMiddleware;
use Hyperf\HttpServer\Router\Router;
use Hyperf\Validation\Middleware\ValidationMiddleware;

Router::addGroup('/auth', function () {
    Router::post('/sign-up', [AuthController::class, 'signUp']);
    Router::post('/sign-in', [AuthController::class, 'signIn']);
}, [
    'middleware' => [
        GlobalMiddleware::class,
        ValidationMiddleware::class
    ]
]);

Router::addGroup('/one', function () {
    Router::addGroup('/user', function () {
        Router::get('/', [UserController::class, 'list']);
        Router::get('/{id}', [UserController::class, 'show']);
    });

    Router::addGroup('/card', function () {
        Router::post('/', [CardController::class, 'create']);
        Router::post('/associate', [CardController::class, 'associate']);

        Router::put('/{id}/unblock', [CardController::class, 'unblock']);

        Router::put('/{id}/balance', [CardController::class, 'balance']);
    });
}, [
    'middleware' => [
        AuthMiddleware::class,
        ValidationMiddleware::class
    ],
]);
