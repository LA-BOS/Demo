<?php
namespace App\Middleware;

class AuthMiddleware
{
    public static function isAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . $_ENV['BASE_URL'] . 'login');
            exit;
        }
    }
}