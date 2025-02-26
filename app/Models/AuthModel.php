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
        
        if ($user) {
            // Try to verify using password_verify for hashed passwords
            $passwordMatches = password_verify($password, $user['password']);
            
            // If that fails, check if the plain text password matches
            // This is a fallback for non-hashed passwords in the database
            if (!$passwordMatches && $password === $user['password']) {
                $passwordMatches = true;
                
                // Optionally, you can update the password to be hashed
                // Uncomment the following code to enable this feature
                /*
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateStmt = $this->queryBuilder->update('users')
                    ->set('password', ':password')
                    ->where('id = :id')
                    ->setParameters([
                        'password' => $hashedPassword,
                        'id' => $user['id']
                    ]);
                $this->connection->executeStatement($updateStmt->getSQL(), $updateStmt->getParameters());
                */
            }
            
            if ($passwordMatches) {
                // Store user info in session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                return true;
            }
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