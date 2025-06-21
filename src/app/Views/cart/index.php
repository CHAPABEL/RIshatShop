<?php ob_start(); ?>
<?php if ($msg = flash('cart_success')): ?>
    <div class="card" style="background:#e6f7e6;color:#1a7f1a;margin-bottom:18px;"> <?= htmlspecialchars($msg) ?> </div>
<?php endif; ?>
<?php if ($msg = flash('cart_error')): ?>
    <div class="card" style="background:#ffeaea;color:#b00;margin-bottom:18px;"> <?= htmlspecialchars($msg) ?> </div>
<?php endif; ?>
<main class="container">
        <h1 style="font-size:2em;font-weight:700;margin-bottom:22px;">Корзина</h1>
<?php if (!empty($products)): ?>
<div class="cart-layout" style="display:flex;gap:32px;align-items:flex-start;justify-content:center;max-width:1500px;">
  <div class="cart-items-col" style="flex:2;min-width:0;">
    <?php foreach ($products as $item): ?>
      <div class="cart-item-card" style="display:flex;align-items:center;gap:20px;background:#fff;border-radius:12px;padding:22px 18px 22px 18px;margin-bottom:18px;box-shadow:0 2px 12px rgba(80,110,140,0.04);">
        <img src="/assets/img/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width:68px;height:68px;object-fit:cover;border-radius:8px;">
        <div style="flex:1;min-width:0;">
          <div style="font-size:1.12em;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"> <?= htmlspecialchars($item['name']) ?> </div>
          <div style="color:#4b6cb7;font-weight:600;margin-top:2px;"> <?= number_format($item['price'],0,',',' ') ?> ₽</div>
        </div>
        <div style="display:flex;align-items:center;gap:8px;">
          <span style="font-size:1.11em;">x<?= $item['qty'] ?></span>
        </div>
        <div style="font-size:1.13em;font-weight:700;margin-left:18px;white-space:nowrap;"> <?= number_format($item['sum'],0,',',' ') ?> ₽</div>
        <a href="/cart?action=remove&id=<?= $item['id'] ?>" class="button" style="background:#eee;color:#333;border:1px solid #e4e6ec;padding:6px 16px;font-size:.97em;margin-left:18px;">Удалить</a>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="cart-summary-col" style="flex:1;min-width:290px;max-width:340px;background:#fff;border-radius:14px;padding:28px 28px 22px 28px;box-shadow:0 2px 16px rgba(80,110,140,0.06);position:sticky;top:32px;">
    <div style="font-size:1.14em;font-weight:600;margin-bottom:12px;">Итого:</div>
    <div style="font-size:1.7em;font-weight:700;margin-bottom:22px;"> <?= number_format($total,0,',',' ') ?> ₽</div>
    <a href="/checkout" class="button" style="display:block;width:100%;background:linear-gradient(90deg,#4b6cb7,#223469);color:#fff;font-size:1.18em;font-weight:600;padding:13px 0;border:none;border-radius:8px;box-shadow:0 2px 8px rgba(34,52,105,0.07);transition:background .18s;text-align:center;margin-bottom:18px;">Оформить заказ</a>
    <form method="post" action="/cart?action=clear">
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
      <button class="button" type="submit" style="background:#eee;color:#333;border:1px solid #e4e6ec;width:100%;padding:10px 0;border-radius:8px;">Очистить корзину</button>
    </form>
    <div style="margin-top:18px;font-size:0.87em;color:#666;">Вы можете изменить количество товаров или удалить ненужные позиции. Все изменения сохраняются автоматически.</div>
  </div>
</div>
<style>
@media (max-width: 900px) {
  .cart-layout { flex-direction: column; gap:18px; }
  .cart-summary-col { max-width:100%; position:static; margin-top:18px; }
}
</style>
<?php else: ?>
    <div class="card">Ваша корзина пуста.</div>
<?php endif; ?>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
