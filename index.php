<?php
session_start();
require 'vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\UserController;
use App\Controllers\CategoryController;
use App\Controllers\ProductController;

use Dotenv\Dotenv;

const ROOT_URL = __DIR__;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// CRUD user
$router->mount('/user', function() use ($router) {
    // http://localhost/PHP2/ASM2/user
    $router->get('/', UserController::class . '@index');
    
    //http://localhost/PHP2/ASM2/user/add
    $router->get('/add', UserController::class . '@add');

    //http://localhost/PHP2/ASM2/user/add
    $router->post('/add', UserController::class . '@addPost');

    //http://localhost/PHP2/ASM2/user/update/1
    $router->get('/update/{id}', UserController::class . '@update');

    //http://localhost/PHP2/ASM2/user/update/1
    $router->post('/update/{id}', UserController::class . '@updatePost');
    //http://localhost/PHP2/ASM2/user/delete/1
    $router->get('/delete/{id}', UserController::class . '@delete');
});

// CRUD category
$router->mount('/category', function() use ($router) {
    // http://localhost/PHP2/ASM2/category
    $router->get('/', CategoryController::class . '@index');
    
    //http://localhost/PHP2/ASM2/category/add
    $router->get('/add', CategoryController::class . '@add');

    //http://localhost/PHP2/ASM2/category/add
    $router->post('/add', CategoryController::class . '@addPost');

    //http://localhost/PHP2/ASM2/category/update/1
    $router->get('/update/{id}', CategoryController::class . '@update');

    //http://localhost/PHP2/ASM2/category/update/1
    $router->post('/update/{id}', CategoryController::class . '@updatePost');
    //http://localhost/PHP2/ASM2/category/delete/1
    $router->get('/delete/{id}', CategoryController::class . '@delete');
});

// CRUD product
$router->mount('/product', function() use ($router) {
    // http://localhost/PHP2/ASM2/product
    $router->get('/', ProductController::class . '@index');
    
    //http://localhost/PHP2/ASM2/product/add
    $router->get('/add', ProductController::class . '@add');

    //http://localhost/PHP2/ASM2/product/add
    $router->post('/add', ProductController::class . '@addPost');

    //http://localhost/PHP2/ASM2/product/update/1
    $router->get('/update/{id}', ProductController::class . '@update');

    //http://localhost/PHP2/ASM2/product/update/1
    $router->post('/update/{id}', ProductController::class . '@updatePost');
    //http://localhost/PHP2/ASM2/product/delete/1
    $router->get('/delete/{id}', ProductController::class . '@delete');
});

$router->run();