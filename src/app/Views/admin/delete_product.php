<?php ob_start(); ?>
<h1>Удалить товар</h1>
<div class="card" style="max-width:400px;">
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <p>Вы уверены, что хотите удалить товар #<?= (int)$id ?>?</p>
        <button class="button" type="submit" style="background:#b00;color:#fff;">Удалить</button>
        <a href="/admin/products" style="margin-left:18px;">Отмена</a>
    </form>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
