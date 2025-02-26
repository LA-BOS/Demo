<?php

namespace App\Models;

use App\Common\Database;

class UserModel
{
    private $queryBuilder;
    private $connection;


    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function getAllUsers()
    {
        // Select * from users
        $stmt = $this->queryBuilder->select('*')
            ->from('users');

        return $stmt->fetchAllAssociative();
    }

    public function addUser(){
        $stmt = $this->queryBuilder->insert('users')
            ->values([
                'name' => ':name',
                'age' => ':age'
            ])
            ->setParameters([
                'name' => $_POST['name'],
                'age' => $_POST['age']
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
    public function updateUser($id){
        $stmt = $this->queryBuilder->select('*')->from('users')
        ->where('id = :id')
        ->setParameters([
            'id' => $id
        ]);
        return $stmt->fetchAssociative();
    }
    public function postUpdateUser($id){
        $stmt = $this->queryBuilder->update('users')
            ->set('name', ':name')
            ->set('age', ':age')
            ->where('id = :id')
            ->setParameters([
                'name' => $_POST['name'],
                'age' => $_POST['age'],
                'id' => $id
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
    public function deleteUser($id){
        $stmt = $this->queryBuilder->delete('users')
            ->where('id = :id')
            ->setParameters([
                'id' => $id
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
}
