<?php
require_once "modules/dashboard/model.php";

layout('sidebar');
layout('header');

layout('footer');
url_css();
function homeAction($pdo) {
    $stats = get_inventory_stats($pdo);
    $low_stock = get_low_stock_products($pdo);
    
    // Lấy 5 giao dịch gần nhất để hiển thị hoạt động
    $recent_activities = db_get_all($pdo, "SELECT it.*, p.name as product_name 
        FROM inventory_transactions it 
        JOIN products p ON it.product_id = p.id 
        ORDER BY it.created_at DESC LIMIT 5");
        
    require_once "modules/dashboard/views/index.php";
}