<?php ob_start(); ?>
<h1>Вход в админ-панель</h1>
<?php if (!empty($error)): ?><div class="error" style="color:#b00;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" style="max-width:340px;">
    <label>Email<br><input type="email" name="email" required autofocus></label><br><br>
    <label>Пароль<br><input type="password" name="password" required></label><br><br>
    <button type="submit" class="button">Войти</button>
</form>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
