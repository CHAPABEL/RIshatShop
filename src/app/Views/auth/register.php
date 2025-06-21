<?php ob_start(); ?>
<h1>Регистрация</h1>
<?php if (!empty($error)): ?>
    <div class="card" style="background:#ffeaea;color:#b00;"> <?= htmlspecialchars($error) ?> </div>
<?php endif; ?>
<div class="card" style="max-width:400px;margin:auto;">
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <label>Email<br><input type="email" name="email" required autofocus></label><br>
        <label>Имя<br><input type="text" name="name" required></label><br>
        <label>Пароль<br><input type="password" name="password" required></label><br>
        <label>Повторите пароль<br><input type="password" name="password2" required></label><br>
        <button class="button" type="submit" style="width:100%;margin-top:12px;">Зарегистрироваться</button>
    </form>
    <div style="margin-top:12px;font-size:.97em;">
        Уже есть аккаунт? <a href="/login">Войти</a>
    </div>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
