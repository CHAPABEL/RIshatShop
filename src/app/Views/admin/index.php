<?php ob_start(); ?>
<h1>Админ-панель</h1>
<div class="card" style="max-width:600px;">
    <h3 style="margin-top:0;">Управление</h3>
    <ul style="font-size:1.1em;">
        <li><a href="/admin/products">Товары</a></li>
        <li><a href="/admin/orders">Заказы</a></li>
        <li><a href="/admin/users">Пользователи</a></li>
    </ul>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
