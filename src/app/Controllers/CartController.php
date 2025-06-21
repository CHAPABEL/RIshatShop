<?php
require_once __DIR__ . '/../Models/Product.php';
class CartController extends Controller {
    public function index() {
        $cart = $_SESSION['cart'] ?? [];
        $products = [];
        $total = 0;
        if ($cart) {
            $productModel = new Product();
            foreach ($cart as $id => $qty) {
                $item = $productModel->getById($id);
                if ($item) {
                    $item['qty'] = $qty;
                    $item['sum'] = $qty * $item['price'];
                    $products[] = $item;
                    $total += $item['sum'];
                }
            }
        }
        $this->view('cart/index', [
            'title' => 'Корзина',
            'products' => $products,
            'total' => $total
        ]);
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !check_csrf($_POST['csrf_token'] ?? '')) {
            http_response_code(400);
            flash('cart_error', 'Ошибка безопасности.');
            redirect('/cart');
        }
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            flash('cart_error', 'Некорректный товар.');
            redirect('/cart');
        }
        $cart = &$_SESSION['cart'];
        if (!isset($cart[$id])) $cart[$id] = 0;
        $cart[$id]++;
        flash('cart_success', 'Товар добавлен в корзину.');
        redirect('/cart');
    }
    public function remove() {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
            flash('cart_success', 'Товар удалён из корзины.');
        }
        redirect('/cart');
    }
    public function clear() {
        unset($_SESSION['cart']);
        flash('cart_success', 'Корзина очищена.');
        redirect('/cart');
    }
}
