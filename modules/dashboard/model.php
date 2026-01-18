<?php
// Thống kê tổng quan
// Trong modules/dashboard/model.php
function get_inventory_stats($pdo) {
    $stats = [];
    $currentMonth = date('Y-m');

    $stats['total_products'] = db_get_one($pdo, "SELECT COUNT(*) as total FROM products WHERE deleted_at IS NULL")['total'];
    
    // Nhập tháng này
    $stats['import_this_month'] = db_get_one($pdo, "SELECT SUM(quantity) as total FROM inventory_transactions 
        WHERE type = 'IN' AND DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])['total'] ?? 0;

    // Xuất tháng này
    $stats['export_this_month'] = db_get_one($pdo, "SELECT SUM(quantity) as total FROM inventory_transactions 
        WHERE type = 'OUT' AND DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])['total'] ?? 0;

    $stats['low_stock_count'] = db_get_one($pdo, "SELECT COUNT(*) as total FROM products WHERE quantity <= 10 AND deleted_at IS NULL")['total'];

    return $stats;
}

// Lấy danh sách sản phẩm sắp hết hàng để hiển thị cảnh báo
function get_low_stock_products($pdo) {
    return db_get_all($pdo, "SELECT name, sku, quantity, unit FROM products WHERE quantity <= 10 AND deleted_at IS NULL ORDER BY quantity ASC LIMIT 5");
}