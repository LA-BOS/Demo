<?php
namespace App\Models;

use App\Common\Database;

class AuthModel
{
    private $queryBuilder;
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function login($email, $password)
    {
        $stmt = $this->queryBuilder->select('*')
            ->from('users')
            ->where('email = :email')
            ->setParameters([
                'email' => $email
            ]);
        
        $user = $stmt->fetchAssociative();
        
        if ($user && password_verify($password, $user['password'])) {
            // Store user info in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            return true;
        }
        
        return false;
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        return true;
    }
}