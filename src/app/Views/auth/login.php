<?php ob_start(); ?>
<h1>Вход</h1>
<?php if ($msg = flash('auth_success')): ?>
    <div class="card" style="background:#e6f7e6;color:#1a7f1a;"> <?= htmlspecialchars($msg) ?> </div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="card" style="background:#ffeaea;color:#b00;"> <?= htmlspecialchars($error) ?> </div>
<?php endif; ?>
<div class="card" style="max-width:400px;margin:auto;">
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <label>Email<br><input type="email" name="email" required autofocus></label><br>
        <label>Пароль<br><input type="password" name="password" required></label><br>
        <button class="button" type="submit" style="width:100%;margin-top:12px;">Войти</button>
    </form>
    <div style="margin-top:12px;font-size:.97em;">
        Нет аккаунта? <a href="/register">Зарегистрироваться</a>
    </div>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
