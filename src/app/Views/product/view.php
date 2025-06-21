<?php ob_start(); ?>
<?php if (!empty($error)): ?>
    <div class="card" style="color:#b00;"> <?= htmlspecialchars($error) ?> </div>
<?php elseif (!empty($product)): ?>
    <div class="product-page-row" style="display:flex;gap:48px;align-items:flex-start;background:#fff;padding:38px 48px 38px 38px;width:100%;max-width:1400px;margin:0 auto;box-sizing:border-box;border-radius:14px;min-height:540px;">
        <div class="product-page-image" style="flex:0 0 480px;max-width:600px;display:flex;align-items:center;justify-content:center;">
            <img src="/assets/img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width:100%;height:440px;object-fit:cover;background:#fff;">
        </div>
        <div class="product-page-info" style="flex:1;display:flex;flex-direction:column;justify-content:flex-start;min-width:260px;padding-left:36px;">
            <div style="font-size:2.2em;font-weight:700;margin-bottom:12px;line-height:1.1;color:#222;"> <?= htmlspecialchars($product['name']) ?> </div>
            <div style="font-size:2em;font-weight:700;color:#222;margin-bottom:18px;"> <?= number_format($product['price'],0,',',' ') ?> ₽</div>
            <form method="post" action="/cart?action=add&amp;id=<?= (int)$product['id'] ?>" style="margin-bottom:28px;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                <button type="submit" style="background:linear-gradient(90deg,#4b6cb7,#223469);color:#fff;font-size:1.18em;font-weight:600;padding:13px 0;border:none;border-radius:8px;cursor:pointer;width:220px;box-shadow:0 2px 8px rgba(34,52,105,0.07);transition:background .18s;">Купить</button>
            </form>
            <div style="font-size:1.08em;margin-bottom:10px;color:#666;">Категория: <b><?= htmlspecialchars($product['category_name'] ?? '') ?></b></div>
            <?php if (!empty($product['description'])): ?>
                <div style="font-size:1.09em;color:#222;max-width:540px;line-height:1.4;"> <?= htmlspecialchars($product['description']) ?> </div>
            <?php endif; ?>
        </div>
    </div>
<style>
@media (max-width: 1100px) {
  .product-page-row { flex-direction: column; align-items: stretch; min-height: 0; padding:18px 8px; }
  .product-page-image { max-width:100%; flex: none; justify-content:center; }
  .product-page-image img { height:220px; }
  .product-page-info { padding-left:0; }
}
</style>
<?php endif; ?>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
