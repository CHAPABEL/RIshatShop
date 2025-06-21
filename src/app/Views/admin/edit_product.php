<?php ob_start(); ?>
<h1>Редактировать товар</h1>
<?php if (!empty($error)): ?>
    <div class="card" style="background:#ffeaea;color:#b00;"> <?= htmlspecialchars($error) ?> </div>
<?php endif; ?>
<?php if (!$product): ?>
    <div class="card">Товар не найден.</div>
<?php else: ?>
<div class="card" style="max-width:500px;">
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <label>Название<br><input type="text" name="name" required value="<?= htmlspecialchars($product['name']) ?>"></label><br>
        <label>Описание<br><textarea name="description" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea></label><br>
        <label>Цена (₽)<br><input type="number" name="price" min="1" step="1" required value="<?= htmlspecialchars($product['price']) ?>"></label><br>
        <label>Категория<br>
            <select name="category_id" required>
                <option value="">-- выберите --</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['id'] ?>"<?= $c['id']==$product['category_id']?' selected':'' ?>><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Файл изображения (имя из /assets/img)<br><input type="text" name="image" required value="<?= htmlspecialchars($product['image']) ?>"></label><br>
        <label><input type="checkbox" name="available" value="1"<?= $product['available']?' checked':'' ?>> В наличии</label><br>
        <button class="button" type="submit" style="margin-top:8px;">Сохранить</button>
        <a href="/admin/products" style="margin-left:18px;">Отмена</a>
    </form>
</div>
<?php endif; ?>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
