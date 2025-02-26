<?php
namespace App\Controllers;

use App\Models\ProductModel;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    private $productModel;
    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel();
    }
    public function index()
    {
        $data = $this->productModel->getAllProducts();
        echo $this->blade->run('list_product', ['data' => $data]);
    }
    public function add()
    {
        $categories = $this->productModel->getAllCategories();
        echo $this->blade->run('add_product', ['categories' => $categories]);
    }
    public function addPost()
    {   
        $validator = new Validator;
        $validation = $validator->make([
            'category_id'  => $_POST['category_id'],
            'name'  => $_POST['name'],
            'img_thumbnail'  => $_FILES['img_thumbnail'],
            'description'  => $_POST['description'],
        ], [
            'category_id'  => 'required|integer',
            'name'  => 'required|min:1|max:50',
            'img_thumbnail'  => 'uploaded_file:0,2M,png,jpg,jpeg',
            'description'  => 'max:255',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'product/add');
            exit;  
        } else {
            echo "Dữ liệu hợp lệ!";
        }
        $image = $_FILES['img_thumbnail'];
        $img_url = null;
        if($image['name'] != '') {
            $imageName = time().'_'.$image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
            $img_url = "uploads/$imageName";
        }
        $this->productModel->addProduct($img_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'product/');
    }
    public function update($id)
    {
        
        $product = $this->productModel->updateProduct($id);
        $categories = $this->productModel->getAllCategories();
        echo $this->blade->run('update_product', ['product' => $product, 'categories' => $categories]);
    }
    public function updatePost($id)
    {
        $validator = new Validator;
        $validation = $validator->make([
            'category_id'  => $_POST['category_id'],
            'name'  => $_POST['name'],
            'img_thumbnail'  => $_FILES['img_thumbnail'],
            'description'  => $_POST['description'],
        ], [
            'category_id'  => 'required|integer',
            'name'  => 'required|min:1|max:50',
            'img_thumbnail'  => 'uploaded_file:0,2M,png,jpg,jpeg',
            'description'  => 'max:255',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . "product/update/$id");
            exit;  
        } else {
            echo "Dữ liệu hợp lệ!";
        }
        $product = $this->productModel->updateProduct($id);
        $image = $_FILES['img_thumbnail'];
        $img_url = $product['img_thumbnail'];
        if($image['name'] != '') {
            unlink($img_url);
            $imageName = time().'_'.$image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
            $img_url = "uploads/$imageName";
        }
        $this->productModel->postUpdateProduct($id, $img_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'product');
    }
    public function delete($id)
    {
        $product = $this->productModel->updateProduct($id);
        if($product['img_thumbnail'] != null) {
            unlink($product['img_thumbnail']);
        }
        $this->productModel->deleteProduct($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'product');
    }
}