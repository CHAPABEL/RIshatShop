<?php ob_start(); ?>
<h1>Оформление заказа</h1>
<?php if ($msg = flash('checkout_error')): ?>
    <div class="card" style="background:#ffeaea;color:#b00;"> <?= htmlspecialchars($msg) ?> </div>
<?php endif; ?>
<?php if (!empty($products)): ?>
    <div class="card">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
            <tr style="background:#f7f7fa;">
                <th style="padding:8px 4px;">Товар</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $item): ?>
            <tr>
                <td style="padding:8px 4px;">
                    <img src="/assets/img/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width:40px;vertical-align:middle;border-radius:4px;margin-right:8px;">
                    <?= htmlspecialchars($item['name']) ?>
                </td>
                <td><?= number_format($item['price'],0,',',' ') ?> ₽</td>
                <td><?= $item['qty'] ?></td>
                <td><?= number_format($item['sum'],0,',',' ') ?> ₽</td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div style="margin-top:18px;font-size:1.1em;font-weight:500;">Итого: <?= number_format($total,0,',',' ') ?> ₽</div>
        <form method="post" style="margin-top:24px;">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <button class="button" type="submit">Подтвердить заказ</button>
        </form>
    </div>
<?php endif; ?>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
