<?php ob_start(); ?>
<h1>Каталог аксессуаров</h1>
<div class="card-filter" style="margin-bottom:24px;max-width:1100px;margin-left:auto;margin-right:auto;">
    <form method="get" style="display:flex;flex-wrap:wrap;gap:16px;align-items:center;">
        <select name="category" class="catalog-filter-input">
            <option value="">Все категории</option>
            <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"<?= ($filters['category']==$cat['id']?' selected':'') ?>><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="search" placeholder="Поиск..." value="<?= htmlspecialchars($filters['search']??'') ?>" class="catalog-filter-input">
        <input type="number" name="min_price" placeholder="Цена от" min="0" value="<?= htmlspecialchars($filters['min_price']??'') ?>" class="catalog-filter-input">
        <input type="number" name="max_price" placeholder="до" min="0" value="<?= htmlspecialchars($filters['max_price']??'') ?>" class="catalog-filter-input">
        <button class="button" type="submit">Фильтровать</button>
    </form>
</div>
<div style="display:flex;flex-wrap:wrap;gap:40px;max-width:1100px;margin:0 auto;">
<?php if (!empty($products)): ?>
    <?php foreach ($products as $item): ?>
    <div class="card catalog-product-card" style="padding:22px;display:flex;flex-direction:column;align-items:stretch;box-sizing:border-box;max-width:340px;width:100%;min-height:420px;">
        <div class="catalog-product-image" style="width:100%;height:240px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
            <img src="/assets/img/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width:100%;height:100%;object-fit:cover;border-radius:10px;box-shadow:0 2px 12px rgba(80,110,140,0.04)">
        </div>
        <div style="font-size:1.25em;font-weight:700;margin-bottom:8px;text-align:left;"> <?= htmlspecialchars($item['name']) ?> </div>
        <div style="color:#4b6cb7;font-weight:600;font-size:1.1em;margin-bottom:6px;text-align:left;"> <?= number_format($item['price'],0,',',' ') ?> ₽</div>
        <div style="margin-bottom:10px;text-align:left;">Категория: <b><?= !empty($item['category_name']) ? htmlspecialchars($item['category_name']) : '—' ?></b></div>
        <?php if (!empty($item['description'])): ?>
        <div class="catalog-product-desc"> <?= htmlspecialchars($item['description']) ?> </div>
        <?php endif; ?>
        <a href="/product?id=<?= $item['id'] ?>" class="button" style="margin-top:auto;width:100%;display:inline-block;text-align:center;">Подробнее</a>
    </div>
<style>
@media (max-width: 600px) {
  .catalog-product-card { max-width:100%!important; }
  .catalog-product-image { height:160px!important; }
}
</style>
    <?php endforeach; ?>
<?php else: ?>
    <div style="padding:32px;">Нет товаров по выбранным фильтрам.</div>
<?php endif; ?>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
