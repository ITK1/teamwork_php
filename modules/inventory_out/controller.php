<?php
require_once "modules/inventory_out/model.php";

layout('sidebar');
layout('header');
layout('home');
layout('footer');
url_css();


require_once "modules/inventory_out/model.php";

// Hàm điều hướng mặc định
function homeAction($pdo) {
    listAction($pdo);
}

function listAction($pdo) {
    // 1. Lấy dữ liệu (như các bước trước)
    $sql = "SELECT it.*, p.name as product_name 
            FROM inventory_transactions it
            JOIN products p ON it.product_id = p.id
            WHERE it.type = 'OUT' 
            ORDER BY it.created_at DESC";
            
    $history = db_get_all($pdo, $sql) ?: [];
    $products = db_get_all($pdo, "SELECT id, name, sku, quantity FROM products WHERE deleted_at IS NULL AND quantity > 0");
    
    // 2. QUAN TRỌNG: Kiểm tra lại đường dẫn này
    require_once "modules/inventory_out/views/list.php"; 
}

// Hàm xử lý thêm phiếu xuất
function addAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (create_export_transaction($pdo, $_POST)) {
            header("Location: index.php?module=inventory_out&action=list&msg=success");
        } else {
            header("Location: index.php?module=inventory_out&action=list&msg=error");
        }
        exit;
    }
}