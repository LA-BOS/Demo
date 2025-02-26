<?php
session_start();
require 'vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\UserController;
use App\Controllers\CategoryController;
use App\Controllers\ProductController;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;

use Dotenv\Dotenv;

const ROOT_URL = __DIR__;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// Authentication routes
$router->get('/login', AuthController::class . '@loginForm');
$router->post('/login', AuthController::class . '@loginPost');
$router->get('/logout', AuthController::class . '@logout');

// Admin dashboard
$router->get('/admin/dashboard', function() use ($router) {
    AuthMiddleware::isAdmin();
    (new AuthController())->dashboard();
});

// Admin routes with middleware
$router->mount('/admin', function() use ($router) {
    // Apply middleware to all admin routes
    $router->before('GET|POST', '/.*', function() {
        AuthMiddleware::isAdmin();
    });
    
    // Admin routes for User
    $router->mount('/user', function() use ($router) {
        $router->get('/', UserController::class . '@index');
        $router->get('/add', UserController::class . '@add');
        $router->post('/add', UserController::class . '@addPost');
        $router->get('/update/{id}', UserController::class . '@update');
        $router->post('/update/{id}', UserController::class . '@updatePost');
        $router->get('/delete/{id}', UserController::class . '@delete');
    });
    
    // Admin routes for Category
    $router->mount('/category', function() use ($router) {
        $router->get('/', CategoryController::class . '@index');
        $router->get('/add', CategoryController::class . '@add');
        $router->post('/add', CategoryController::class . '@addPost');
        $router->get('/update/{id}', CategoryController::class . '@update');
        $router->post('/update/{id}', CategoryController::class . '@updatePost');
        $router->get('/delete/{id}', CategoryController::class . '@delete');
    });
    
    // Admin routes for Product
    $router->mount('/product', function() use ($router) {
        $router->get('/', ProductController::class . '@index');
        $router->get('/add', ProductController::class . '@add');
        $router->post('/add', ProductController::class . '@addPost');
        $router->get('/update/{id}', ProductController::class . '@update');
        $router->post('/update/{id}', ProductController::class . '@updatePost');
        $router->get('/delete/{id}', ProductController::class . '@delete');
    });
});

// Old routes should redirect to admin routes
$router->mount('/user', function() use ($router) {
    $router->get('/', function() {
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/user');
        exit;
    });
    $router->get('/add', function() {
        header('Location: ' . $_ENV['BASE_URL'] . 'admin/user/add');
        exit;
    });
    // Similarly for other user routes
});

// Similar redirects for category and product routes

$router->run();