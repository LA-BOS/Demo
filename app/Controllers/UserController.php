<?php
namespace App\Controllers;

use App\Models\UserModel;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $data = $this->userModel->getAllUsers($search);
        echo $this->blade->run('list_user', ['data' => $data, 'search' => $search]);
    }
    public function add()
    {
        echo $this->blade->run('add_user');
    }
    public function addPost()
    {   
        $validator = new Validator;
        $validation = $validator->make([
            'name'  => $_POST['name'],
            'age'   => $_POST['age']
        ], [
            'name'  => 'required|min:4|max:50|alpha',
            'age'   => 'required|integer|min:0|max:100'
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'user/add');
            exit;  
        } else {
            echo "Dữ liệu hợp lệ!";
        }
        $this->userModel->addUser();
        header('Location: ' . $_ENV['BASE_URL'] . 'user');
    }
    public function update($id)
    {
        
        $user = $this->userModel->updateUser($id);
        echo $this->blade->run('update_user', ['user' => $user]);
    }
    public function updatePost($id)
    {
        $validator = new Validator;
        $validation = $validator->make([
            'name'  => $_POST['name'],
            'age'   => $_POST['age']
        ], [
            'name'  => 'required|min:4|max:50',
            'age'   => 'required|integer|min:0|max:100'
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'user/update/' . $id);
            exit;  
        } else {
            echo "Dữ liệu hợp lệ!";
        }
        $this->userModel->postUpdateUser($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'user');
    }
    public function delete($id)
    {
        $this->userModel->deleteUser($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'user');
    }
}