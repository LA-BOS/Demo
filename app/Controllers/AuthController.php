<?php
namespace App\Controllers;

use App\Models\AuthModel;
use Rakit\Validation\Validator;

class AuthController extends Controller
{
    private $authModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->authModel = new AuthModel();
    }
    
    public function loginForm()
    {
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            header('Location: ' . $_ENV['BASE_URL'] . 'admin/dashboard');
            exit;
        }
        
        echo $this->blade->run('login');
    }
    
    public function loginPost()
    {
        $validator = new Validator;
        $validation = $validator->make([
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ], [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $validation->validate();
        
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'login');
            exit;
        }
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if ($this->authModel->login($email, $password)) {
            // Check if user is admin
            if ($_SESSION['user']['role'] === 'admin') {
                header('Location: ' . $_ENV['BASE_URL'] . 'admin/dashboard');
                exit;
            } else {
                $_SESSION['errors'] = ['Bạn không có quyền truy cập trang quản trị'];
                $this->authModel->logout(); // Log them out if not admin
                header('Location: ' . $_ENV['BASE_URL'] . 'login');
                exit;
            }
        } else {
            $_SESSION['errors'] = ['Email hoặc mật khẩu không đúng'];
            header('Location: ' . $_ENV['BASE_URL'] . 'login');
            exit;
        }
    }
    
    public function logout()
    {
        $this->authModel->logout();
        header('Location: ' . $_ENV['BASE_URL'] . 'login');
        exit;
    }
    
    public function dashboard()
    {
        echo $this->blade->run('dashboard');
    }
}