<?php ob_start(); ?>
<h1>Товары</h1>
<div class="card" style="margin-bottom:18px;">
    <a href="/admin/products/add" class="button" style="float:right;">+ Добавить товар</a>
    <div style="clear:both"></div>
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr><th>ID</th><th>Название</th><th>Категория</th><th>Цена</th><th>Статус</th><th></th></tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= htmlspecialchars($p['category_name'] ?? $p['category_id']) ?></td>
                <td><?= number_format($p['price'], 0, ',', ' ') ?> ₽</td>
                <td><?= $p['available'] ? 'В наличии' : 'Нет' ?></td>
                <td>
                    <a href="/admin/products/edit?id=<?= $p['id'] ?>">Редактировать</a> |
                    <a href="/admin/products/delete?id=<?= $p['id'] ?>" onclick="return confirm('Удалить товар?');">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
