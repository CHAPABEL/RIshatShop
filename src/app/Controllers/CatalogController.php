<?php
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Category.php';
class CatalogController extends Controller {
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();
        $filters = [
            'category' => $_GET['category'] ?? null,
            'search' => $_GET['search'] ?? null,
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null
        ];
        $products = $productModel->getAll($filters);
        $categories = $categoryModel->getAll();
        $this->view('catalog/index', [
            'title' => 'Каталог',
            'products' => $products,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }
}
