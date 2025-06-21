<?php
require_once __DIR__ . '/../Models/User.php';
class UserController extends Controller {
    public function profile() {
        if (empty($_SESSION['user_id'])) {
            redirect('/login');
        }
        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);
        // Получить заказы пользователя
        $orders = [];
        $pdo = $userModel->getPdo();
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE user_id = :uid ORDER BY created_at DESC');
        $stmt->execute([':uid' => $user['id']]);
        $orders = $stmt->fetchAll();
        // Смена пароля
        $msg = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password']) && check_csrf($_POST['csrf_token'] ?? '')) {
            $old = $_POST['old_password'] ?? '';
            $new = $_POST['new_password'] ?? '';
            $new2 = $_POST['new_password2'] ?? '';
            if (!password_verify($old, $user['password'])) {
                $msg = ['type'=>'error','text'=>'Старый пароль неверен.'];
            } elseif ($new !== $new2) {
                $msg = ['type'=>'error','text'=>'Новые пароли не совпадают.'];
            } elseif (strlen($new)<6) {
                $msg = ['type'=>'error','text'=>'Пароль должен быть не короче 6 символов.'];
            } else {
                $hash = password_hash($new, PASSWORD_BCRYPT);
                $stmt2 = $pdo->prepare('UPDATE users SET password=:p WHERE id=:id');
                $stmt2->execute([':p'=>$hash,':id'=>$user['id']]);
                $msg = ['type'=>'success','text'=>'Пароль успешно изменён.'];
            }
            // Обновить пользователя после смены пароля
            $user = $userModel->getById($_SESSION['user_id']);
        }
        $this->view('user/profile', [
            'title' => 'Профиль',
            'user' => $user,
            'orders' => $orders,
            'msg' => $msg
        ]);
    }
}
