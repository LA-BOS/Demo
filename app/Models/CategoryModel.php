<?php

namespace App\Models;

use App\Common\Database;

class CategoryModel
{
    private $queryBuilder;
    private $connection;


    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function getAllCategories($search = null)
    {
        $query = $this->queryBuilder->select('*')
            ->from('categories');
            
        if ($search) {
            $query->where('name LIKE :search')
                  ->setParameter('search', '%' . $search . '%');
        }
        
        return $query->fetchAllAssociative();
    }

    public function addCategory(){
        $stmt = $this->queryBuilder->insert('categories')
            ->values([
                'name' => ':name',
            ])
            ->setParameters([
                'name' => $_POST['name']
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
    public function updateCategory($id){
        $stmt = $this->queryBuilder->select('*')->from('categories')
        ->where('id = :id')
        ->setParameters([
            'id' => $id
        ]);
        return $stmt->fetchAssociative();
    }
    public function postUpdateCategory($id){
        $stmt = $this->queryBuilder->update('categories')
            ->set('name', ':name')
            ->where('id = :id')
            ->setParameters([
                'name' => $_POST['name'],
                'id' => $id
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
    public function deleteCategory($id){
        $stmt = $this->queryBuilder->delete('categories')
            ->where('id = :id')
            ->setParameters([
                'id' => $id
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
}