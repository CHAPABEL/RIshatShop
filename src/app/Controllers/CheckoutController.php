<?php
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/User.php';
class CheckoutController extends Controller {
    public function index() {
        if (empty($_SESSION['cart'])) {
            flash('checkout_error', 'Корзина пуста.');
            redirect('/cart');
        }
        if (empty($_SESSION['user_id'])) {
            flash('checkout_error', 'Для оформления заказа войдите или зарегистрируйтесь.');
            redirect('/login');
        }
        $productModel = new Product();
        $cart = $_SESSION['cart'];
        $products = [];
        $total = 0;
        foreach ($cart as $id => $qty) {
            $item = $productModel->getById($id);
            if ($item) {
                $item['qty'] = $qty;
                $item['sum'] = $qty * $item['price'];
                $products[] = $item;
                $total += $item['sum'];
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_csrf($_POST['csrf_token'] ?? '')) {
            // Сохраняем заказ
            $user_id = $_SESSION['user_id'];
            $pdo = $productModel->db;
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('INSERT INTO orders (user_id, status, total) VALUES (:uid, "new", :total)');
            $stmt->execute([':uid' => $user_id, ':total' => $total]);
            $order_id = $pdo->lastInsertId();
            $stmt2 = $pdo->prepare('INSERT INTO order_items (order_id, product_id, quantity) VALUES (:oid, :pid, :qty)');
            foreach ($products as $item) {
                $stmt2->execute([':oid' => $order_id, ':pid' => $item['id'], ':qty' => $item['qty']]);
            }
            $pdo->commit();
            unset($_SESSION['cart']);
            flash('checkout_success', 'Заказ успешно оформлен!');
            redirect('/profile');
        }
        $this->view('checkout/index', [
            'title' => 'Оформление заказа',
            'products' => $products,
            'total' => $total
        ]);
    }
}
