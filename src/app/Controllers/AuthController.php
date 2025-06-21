<?php
require_once __DIR__ . '/../Models/User.php';
class AuthController extends Controller {
    public function login() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_csrf($_POST['csrf_token'] ?? '')) {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            if (!$email || !$password) {
                $error = 'Введите email и пароль.';
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($email);
                if (!$user || !password_verify($password, $user['password'])) {
                    $error = 'Неверный email или пароль.';
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_role'] = $user['role'];
                    redirect('/profile');
                }
            }
        }
        $this->view('auth/login', ['title' => 'Вход', 'error' => $error]);
    }
    public function register() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_csrf($_POST['csrf_token'] ?? '')) {
            $email = trim($_POST['email'] ?? '');
            $name = trim($_POST['name'] ?? '');
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';
            if (!$email || !$name || !$password || !$password2) {
                $error = 'Заполните все поля.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Некорректный email.';
            } elseif ($password !== $password2) {
                $error = 'Пароли не совпадают.';
            } elseif (strlen($password) < 6) {
                $error = 'Пароль должен быть не короче 6 символов.';
            } else {
                $userModel = new User();
                if ($userModel->findByEmail($email)) {
                    $error = 'Пользователь с таким email уже существует.';
                } else {
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $userModel->create($email, $hash, $name);
                    flash('auth_success', 'Регистрация прошла успешно. Теперь войдите.');
                    redirect('/login');
                }
            }
        }
        $this->view('auth/register', ['title' => 'Регистрация', 'error' => $error]);
    }
    public function logout() {
        session_destroy();
        redirect('/');
    }
}
