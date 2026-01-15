<?php
/**
 * File: modules/common/controller.php
 */

// Tên hàm PHẢI khớp với logic trong index.php ($action + 'Action')
function homeAction($pdo) {
    // 1. Lấy dữ liệu sản phẩm cho trang người dùng
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.deleted_at IS NULL AND p.status = 1 
            ORDER BY p.id DESC LIMIT 8";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();

    // 2. Nạp View - Đảm bảo đường dẫn đúng từ gốc
    require_once "views/home.php";
}