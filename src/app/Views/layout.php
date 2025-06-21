<?php
// Подсчёт суммы корзины для бейджа в хедере
$cartTotal = 0;
if (!empty($_SESSION['cart'])) {
    require_once __DIR__ . '/../Models/Product.php';
    $productModel = new Product();
    foreach ($_SESSION['cart'] as $id => $qty) {
        $item = $productModel->getById($id);
        if ($item) $cartTotal += $item['price'] * $qty;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= $title ?? 'Магазин аксессуаров' ?></title>
    <link rel="stylesheet" href="/assets/fonts/Inter.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="header" style="background:#fff;box-shadow:0 1px 6px rgba(80,110,140,0.06);padding:0;">
        <div class="container" style="display:flex;align-items:center;gap:20px;min-height:62px;">
            <a href="/" style="font-weight:700;font-size:1.3rem;color:var(--primary);text-decoration:none;margin-right:10px;">Vibe Shop</a>
            <a href="/catalog" class="button" style="min-width:100px;padding:8px 18px;font-size:1em;margin-right:18px;">Каталог</a>
            <form action="/catalog" method="get" style="flex:1;max-width:520px;">
                <input type="text" name="search" placeholder="Поиск по сайту" style="width:100%;height:38px;border-radius:8px;border:1px solid #e6eaf3;background:#fafdff;padding:0 14px;font-size:1em;color:#222;outline:none;transition: all 200ms cubic-bezier(0.4,0,0.2,1);background:#fafdff;box-sizing:border-box;">
            </form>
            <div style="display:flex;align-items:center;gap:22px;margin-left:24px;">
                <a href="/cart" style="color:#7a869a;font-size:.97em;text-decoration:none;position:relative;font-weight:400;">
    <span style="font-weight:400;">Корзина</span>
    <span style="background:linear-gradient(90deg,#4a6fc1 0%,#23345d 100%);color:#fff;border-radius:8px;padding:2px 12px;font-size:.93em;margin-left:6px;font-weight:400;">
        <?= isset($cartTotal) ? htmlspecialchars($cartTotal) . ' ₽' : '0 ₽' ?>
    </span>
</a>
                <a href="/profile" class="button" style="min-width:100px;padding:8px 18px;font-size:1em;text-align:center;">Профиль</a>
            </div>
        </div>
    </div>
    <main class="container">
        <?php if (isset($content)) echo $content; ?>
    </main>
</body>
</html>
