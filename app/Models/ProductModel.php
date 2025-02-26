<?php

namespace App\Models;

use App\Common\Database;

class ProductModel
{
    private $queryBuilder;
    private $connection;


    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->queryBuilder = Database::getQueryBuilder();
    }

    public function getAllProducts($search = null)
    {
        $query = $this->queryBuilder->select('p.*', 'c.name as category_name')
            ->from('products', 'p')
            ->join('p', 'categories', 'c', 'p.category_id = c.id')
            ->orderBy('p.id', 'desc');
            
        if ($search) {
            $query->where('p.name LIKE :search')
                  ->setParameter('search', '%' . $search . '%');
        }
        
        return $query->fetchAllAssociative();
    }
    public function getAllCategories()
    {
        $stmt = $this->queryBuilder->select('c.*')->from('categories', 'c');
        return $stmt->fetchAllAssociative();
    }
    public function addProduct($img_url){
        $stmt = $this->queryBuilder->insert('products')
            ->values([
                'category_id' => ':category_id',
                'name' => ':name',
                'img_thumbnail' => ':img_thumbnail',
                'description' => ':description',
                'created_at' => ':created_at',
            ])
            ->setParameters([
                'category_id' => $_POST['category_id'],
                'name' => $_POST['name'],
                'img_thumbnail' => $img_url,
                'description' => $_POST['description'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
    public function updateProduct($id){
        $stmt = $this->queryBuilder->select('p.*')->from('products', 'p')
        ->where('p.id = :id')
        ->setParameters([
            'id' => $id
        ]);
        return $stmt->fetchAssociative();
    }
    public function postUpdateProduct($id, $img_url){
        $stmt=$this->queryBuilder
        ->update('products')
        ->set('category_id', ':category_id')
        ->set('name', ':name')
        ->set('img_thumbnail', ':img_thumbnail')
        ->set('description', ':description')
        ->set('updated_at', ':updated_at')
        ->where('id = :id')
        ->setParameters([
            'category_id' => $_POST['category_id'],
            'name' => $_POST['name'],
            'img_thumbnail' => $img_url,
            'description' => $_POST['description'],
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $id
        ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
    public function deleteProduct($id){
        $stmt = $this->queryBuilder->delete('products')
            ->where('id = :id')
            ->setParameters([
                'id' => $id
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
}