<?php ob_start(); ?>
<h1>Заказы</h1>
<div class="card">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr><th>ID</th><th>Пользователь</th><th>Сумма</th><th>Статус</th><th>Дата</th></tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td><?= $o['id'] ?></td>
                <td><?= htmlspecialchars($o['user_email']) ?><?php if ($o['user_name']): ?> (<?= htmlspecialchars($o['user_name']) ?>)<?php endif; ?></td>
                <td><?= number_format($o['total'],0,',',' ') ?> ₽</td>
                <td><?= htmlspecialchars($o['status']) ?></td>
                <td><?= htmlspecialchars($o['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
