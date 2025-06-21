<?php
require_once __DIR__ . '/../Models/Product.php';
class ProductController extends Controller {
    public function view($view = null, $data = []) {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            http_response_code(404);
            parent::view('product/view', ['title' => 'Товар', 'error' => 'Товар не найден']);
            return;
        }
        $productModel = new Product();
        $product = $productModel->getById($id);
        if (!$product) {
            http_response_code(404);
            parent::view('product/view', ['title' => 'Товар', 'error' => 'Товар не найден']);
            return;
        }
        parent::view('product/view', ['title' => $product['name'], 'product' => $product]);
    }
}
