<?php ob_start(); ?>
<h1>Пользователи</h1>
<div class="card">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr><th>ID</th><th>Email</th><th>Имя</th><th>Роль</th><th>Регистрация</th><th>Заказов</th></tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['role']) ?></td>
                <td><?= htmlspecialchars($u['created_at']) ?></td>
                <td><?= $u['orders_count'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
