<?php
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Category.php';
class HomeController extends Controller {
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();
        $popular = $productModel->getPopular(6);
        $categories = $categoryModel->getAll();
        $this->view('home/index', [
            'title' => 'Главная',
            'popular' => $popular,
            'categories' => $categories
        ]);
    }
}
