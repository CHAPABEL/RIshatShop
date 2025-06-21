<?php ob_start(); ?>
<h1 style="font-size:2.3em;font-weight:700;margin-bottom:30px;">Профиль</h1>
<div class="profile-layout" style="display:flex;justify-content:center;max-width:1100px;margin:0 auto 38px auto;">
  <form method="post" style="flex:1;max-width:900px;display:flex;flex-wrap:wrap;gap:20px 24px;align-items:flex-start;background:#fff;border-radius:13px;padding:38px 34px 28px 34px;box-shadow:0 2px 16px rgba(80,110,140,0.08);min-width:320px;">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <div style="width:100%;max-width:420px;margin-bottom:18px;">
      <label style="font-size:.98em;color:#888;display:block;">Имя
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" style="width:100%;margin-top:4px;padding:10px 12px;border:1px solid #e4e6ec;border-radius:7px;background:#f7f8fa;">
      </label>
    </div>
    <div style="width:100%;max-width:420px;margin-bottom:18px;">
      <label style="font-size:.98em;color:#888;display:block;">Электронная почта
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" style="width:100%;margin-top:4px;padding:10px 12px;border:1px solid #e4e6ec;border-radius:7px;background:#f7f8fa;">
      </label>
    </div>
    <div style="flex:1 1 100%;margin-top:24px;display:flex;gap:16px;align-items:center;">
      <a href="/logout" class="button" style="background:#e4e6ec;color:#223469;font-weight:600;padding:10px 28px;border-radius:7px;">Выйти</a>
      <a href="#password" onclick="document.getElementById('change-password-block').style.display='block';return false;" class="button" style="background:linear-gradient(90deg,#4b6cb7,#223469);color:#fff;font-weight:600;padding:10px 28px;border-radius:7px;">Сменить пароль</a>
      <a href="/profile/delete" style="margin-left:auto;color:#b00;font-size:1.07em;">Удалить профиль</a>
    </div>
  </form>
</div>
<!-- Смена пароля -->
<div id="change-password-block" class="card" style="max-width:420px;margin-bottom:32px;display:none;margin-left:auto;margin-right:auto;">
    <h3 style="margin-top:0;">Смена пароля</h3>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <input type="hidden" name="change_password" value="1">
        <label>Старый пароль<br><input type="password" name="old_password" required></label><br>
        <label>Новый пароль<br><input type="password" name="new_password" required></label><br>
        <label>Повторите новый пароль<br><input type="password" name="new_password2" required></label><br>
        <button class="button" type="submit" style="margin-top:8px;">Сменить пароль</button>
    </form>
</div>
<div class="card">
    <h3 style="margin-top:0;">Ваши заказы</h3>
    <?php if (!empty($orders)): ?>
        <table style="width:100%;border-collapse:collapse;">
            <thead><tr><th>ID</th><th>Статус</th><th>Сумма</th><th>Дата</th></tr></thead>
            <tbody>
            <?php foreach ($orders as $o): ?>
                <tr>
                    <td><?= $o['id'] ?></td>
                    <td><?= htmlspecialchars($o['status']) ?></td>
                    <td><?= number_format($o['total'],0,',',' ') ?> ₽</td>
                    <td><?= htmlspecialchars($o['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div>У вас пока нет заказов.</div>
    <?php endif; ?>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
