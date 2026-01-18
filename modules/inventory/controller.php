<?php
require_once "modules/inventory/model.php";

layout('sidebar');
layout('header');
layout('home');
layout('footer');
url_css();
function homeAction($pdo) { listAction($pdo); }

function listAction($pdo) {
    // Lấy lịch sử nhập kho kết hợp lấy tên SP và tên NCC
    $sql = "SELECT it.*, p.name as product_name, s.name as supplier_name 
            FROM inventory_transactions it
            JOIN products p ON it.product_id = p.id
            JOIN suppliers s ON it.supplier_id = s.id
            WHERE it.type = 'IN' 
            ORDER BY it.created_at DESC";
            
    // Đảm bảo luôn có mảng $history để không bị lỗi foreach trong View
    $history = db_get_all($pdo, $sql) ?: [];
    
    // Lấy dữ liệu cho các ô Select trong Modal
    $products = db_get_all($pdo, "SELECT id, name, sku FROM products WHERE deleted_at IS NULL");
    $suppliers = db_get_all($pdo, "SELECT id, name FROM suppliers WHERE status = 1");
    
    require_once "modules/inventory/views/list.php";
}

function addAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Thực hiện nghiệp vụ nhập kho
        if (create_import_transaction($pdo, $_POST)) {
            header("Location: index.php?module=inventory&action=list&msg=success");
        } else {
            header("Location: index.php?module=inventory&action=list&msg=error");
        }
        exit;
    }
}