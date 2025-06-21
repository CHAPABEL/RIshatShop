<?php
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/User.php';
class AdminController extends Controller {
    public function login() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $userModel = new User();
            $user = $userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password']) && $email === 'admin@site.ru') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                redirect('/admin/products');
            } else {
                $error = 'Неверный логин или пароль';
            }
        }
        $this->view('admin/login', ['title' => 'Вход в админку', 'error' => $error]);
    }
    public function login() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $userModel = new User();
            $user = $userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password']) && $email === 'admin@site.ru') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                redirect('/admin/products');
            } else {
    private function checkAdmin() {
        if (empty($_SESSION['user_id'])) {
            redirect('/admin/login');
        }
        // Проверяем, что пользователь — только admin@site.ru
        if (($_SESSION['user_email'] ?? '') !== 'admin@site.ru') {
            session_destroy();
            redirect('/admin/login');
        }
    }
    public function index() {
        $this->checkAdmin();
        $this->view('admin/index', ['title' => 'Админ-панель']);
    }
    public function products() {
        $this->checkAdmin();
        $productModel = new Product();
        // Получить все товары с валидными картинками
        $products = $productModel->getAll();
        $this->view('admin/products', [
            'title' => 'Товары',
            'products' => $products
        ]);
    }
    public function addProduct() {
        $this->checkAdmin();
        $error = null;
        $productModel = new Product();
        $pdo = $productModel->getPdo();
        // Получить категории для выпадающего списка
        $categories = $pdo->query('SELECT id, name FROM categories ORDER BY name')->fetchAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_csrf($_POST['csrf_token'] ?? '')) {
            $name = trim($_POST['name'] ?? '');
            $desc = trim($_POST['description'] ?? '');
            $price = floatval($_POST['price'] ?? 0);
            $category_id = intval($_POST['category_id'] ?? 0);
            $image = trim($_POST['image'] ?? '');
            $available = !empty($_POST['available']) ? 1 : 0;
            if (!$name || !$desc || !$price || !$category_id || !$image) {
                $error = 'Все поля обязательны.';
            } elseif ($price <= 0) {
                $error = 'Цена должна быть положительным числом.';
            } else {
                // Проверка существования категории
                $cat = $pdo->prepare('SELECT id FROM categories WHERE id=?');
                $cat->execute([$category_id]);
                if (!$cat->fetch()) {
                    $error = 'Категория не найдена.';
                } else {
                    $productModel->create($name, $desc, $price, $category_id, $image, $available);
                    flash('admin_success', 'Товар успешно добавлен!');
                    redirect('/admin/products');
                }
            }
        }
        $this->view('admin/add_product', [
            'title' => 'Добавить товар',
            'categories' => $categories,
            'error' => $error
        ]);
    }
    public function editProduct() {
        $this->checkAdmin();
        $error = null;
        $productModel = new Product();
        $pdo = $productModel->getPdo();
        $id = intval($_GET['id'] ?? 0);
        $product = $productModel->getById($id);
        if (!$product) {
            $error = 'Товар не найден.';
            $categories = [];
        } else {
            $categories = $pdo->query('SELECT id, name FROM categories ORDER BY name')->fetchAll();
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_csrf($_POST['csrf_token'] ?? '')) {
                $name = trim($_POST['name'] ?? '');
                $desc = trim($_POST['description'] ?? '');
                $price = floatval($_POST['price'] ?? 0);
                $category_id = intval($_POST['category_id'] ?? 0);
                $image = trim($_POST['image'] ?? '');
                $available = !empty($_POST['available']) ? 1 : 0;
                if (!$name || !$desc || !$price || !$category_id || !$image) {
                    $error = 'Все поля обязательны.';
                } elseif ($price <= 0) {
                    $error = 'Цена должна быть положительным числом.';
                } else {
                    $cat = $pdo->prepare('SELECT id FROM categories WHERE id=?');
                    $cat->execute([$category_id]);
                    if (!$cat->fetch()) {
                        $error = 'Категория не найдена.';
                    } else {
                        $productModel->update($id, $name, $desc, $price, $category_id, $image, $available);
                        flash('admin_success', 'Товар успешно обновлён!');
                        redirect('/admin/products');
                    }
                }
            }
        }
        $this->view('admin/edit_product', [
            'title' => 'Редактировать товар',
            'categories' => $categories,
            'product' => $product,
            'error' => $error
        ]);
    }
    public function deleteProduct() {
        $this->checkAdmin();
        $id = intval($_GET['id'] ?? 0);
        $productModel = new Product();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_csrf($_POST['csrf_token'] ?? '')) {
            $productModel->delete($id);
            flash('admin_success', 'Товар удалён.');
            redirect('/admin/products');
        }
        // Форма подтверждения (fallback, если нет JS)
        $this->view('admin/delete_product', [
            'title' => 'Удалить товар',
            'id' => $id
        ]);
    }
    public function users() {
        $this->checkAdmin();
        $userModel = new User();
        $pdo = $userModel->db;
        $users = $pdo->query('SELECT u.*, (SELECT COUNT(*) FROM orders o WHERE o.user_id=u.id) as orders_count FROM users u ORDER BY u.created_at DESC')->fetchAll();
        $this->view('admin/users', [
            'title' => 'Пользователи',
            'users' => $users
        ]);
    }
    public function orders() {
        $this->checkAdmin();
        $productModel = new Product();
        $pdo = $productModel->getPdo();
        $orders = $pdo->query('SELECT o.*, u.email as user_email, u.name as user_name FROM orders o LEFT JOIN users u ON o.user_id=u.id ORDER BY o.created_at DESC')->fetchAll();
        $this->view('admin/orders', [
            'title' => 'Заказы',
            'orders' => $orders
        ]);
    }
}
