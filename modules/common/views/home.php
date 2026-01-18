<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ - Cửa Hàng</title>
    <style>
        .container { width: 80%; margin: auto; }
        .product-list { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .card { border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: center; }
        .price { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Chào mừng bạn đến với Cửa hàng</h1>
            <p><a href="index.php?module=dashboard">Vào trang Quản trị (Admin)</a></p>
        </header>

        <section class="product-list">
            <?php if(!empty($products)): ?>
                <?php foreach($products as $item): ?>
                    <div class="card">
                        <h3><?= $item['name'] ?></h3>
                        <p class="price">Giá: <?= number_format($item['price_import'] * 1.1) ?>đ</p>
                        <p>Đơn vị: <?= $item['unit'] ?></p>
                        <button>Mua ngay</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Hiện tại chưa có sản phẩm nào.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>