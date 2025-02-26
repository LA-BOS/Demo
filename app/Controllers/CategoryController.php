<?php
namespace App\Controllers;

use App\Models\CategoryModel;
use Rakit\Validation\Validator;

class CategoryController extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        $data = $this->categoryModel->getAllCategories();
        echo $this->blade->run('list_category', ['data' => $data]);
    }
    public function add()
    {
        echo $this->blade->run('add_category');
    }
    public function addPost()
    {   
        $validator = new Validator;
        $validation = $validator->make([
            'name'  => $_POST['name'],
        ], [
            'name'  => 'required|min:4|max:100',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'category/add');
            exit;  
        } else {
            echo "Dữ liệu hợp lệ!";
        }
        $this->categoryModel->addCategory();
        header('Location: ' . $_ENV['BASE_URL'] . 'category');
    }
    public function update($id)
    {
        
        $category = $this->categoryModel->updateCategory($id);
        echo $this->blade->run('update_category', ['category' => $category]);
    }
    public function updatePost($id)
    {
        $validator = new Validator;
        $validation = $validator->make([
            'name'  => $_POST['name'],
        ], [
            'name'  => 'required|min:4|max:50',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'category/update/' . $id);
            exit;  
        } else {
            echo "Dữ liệu hợp lệ!";
        }
        $this->categoryModel->postUpdateCategory($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'category');
    }
    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'category');
    }
}