<?php ob_start(); ?>
<h1 style="margin-bottom:24px;">Добро пожаловать в Vibe Shop!</h1>
<div class="card" style="max-width:100vw;">
    <h2>Популярные товары</h2>
    <?php
    // Считаем количество реально отображаемых карточек
    $shown = 0;
    if (!empty($popular)) {
        ob_start();
?>
    <div style="display:flex;flex-wrap:wrap;gap:32px;width:100%;justify-content:flex-start;">
        <?php foreach ($popular as $item):
            $hasCyrillic = preg_match('/[ÐÑ�]/u', $item['name']) || (!empty($item['description']) && preg_match('/[ÐÑ�]/u', $item['description']));
            $imgPath = '/assets/img/' . $item['image'];
            if ($hasCyrillic || !file_exists($_SERVER['DOCUMENT_ROOT'].$imgPath)) continue;
            $shown++;
        ?>
        <div class="card" style="width:340px;min-width:320px;max-width:100%;padding:20px;display:flex;flex-direction:column;align-items:stretch;">
            <div style="height:120px;background:#f0f2f7;border-radius:6px;margin-bottom:8px;display:flex;align-items:center;justify-content:center;">
                <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="max-width:90%;max-height:90%;">
            </div>
            <div style="font-weight:500;min-height:40px;"> <?= htmlspecialchars($item['name']) ?> </div>
            <div style="color:#4b6cb7;font-weight:600;"> <?= number_format($item['price'], 0, ',', ' ') ?> ₽</div>
            <a href="/product?id=<?= $item['id'] ?>" class="button" style="margin-top:auto;width:100%;display:inline-block;text-align:center;">Подробнее</a>
        </div>
        <?php endforeach; ?>
    </div>
<?php
        $cardsHtml = ob_get_clean();
        if ($shown > 0) {
            echo $cardsHtml;
        } else {
            echo '<div style="text-align:center;min-height:120px;display:flex;align-items:center;justify-content:center;">Нет популярных товаров.</div>';
        }
    } else {
        echo '<div style="text-align:center;min-height:120px;display:flex;align-items:center;justify-content:center;">Нет популярных товаров.</div>';
    }
?>
</div>
<div class="card" style="margin-bottom:24px;max-width:100vw;">
    <h2>Категории</h2>
    <?php if (!empty($categories)): ?>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
        <?php foreach ($categories as $cat):
            if (preg_match('/[ÐÑ�]/u', $cat['name'])) continue; ?>
        <a href="/catalog?category=<?= $cat['id'] ?>" style="padding:8px 18px;background:#f7f7fa;border:1px solid #e4e6ec;border-radius:6px;text-decoration:none;color:#21243d;font-size:1rem;">
            <?= htmlspecialchars($cat['name']) ?>
        </a>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div>Нет категорий.</div>
    <?php endif; ?>
</div>
<?php $content = ob_get_clean(); include __DIR__.'/../layout.php'; ?>
