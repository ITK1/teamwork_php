<?php
function get_products($pdo, $keyword = '', $cat_id = '') {
    // JOIN với bảng categories để lấy tên danh mục hiển thị
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.deleted_at IS NULL";
    
    $params = [];
    
    // Lọc theo từ khóa (SKU hoặc Tên)
    if ($keyword) {
        $sql .= " AND (p.name LIKE ? OR p.sku LIKE ?)";
        $params[] = "%$keyword%";
        $params[] = "%$keyword%";
    }
    
    // Lọc theo Danh mục nếu có chọn
    if ($cat_id && $cat_id != '0') {
        $sql .= " AND p.category_id = ?";
        $params[] = $cat_id;
    }
    
    $sql .= " ORDER BY p.id DESC";
    return db_get_all($pdo, $sql, $params);
}

function insert_product($pdo, $data) {
    $sql = "INSERT INTO products (sku, name, image, category_id, unit, price_import, status) VALUES (?,?,?,?,?,?,?)";
    return db_execute($pdo, $sql, [
        $data['sku'], $data['name'], $data['image'], 
        $data['category_id'], $data['unit'], $data['price_import'], $data['status']
    ]);
}

function update_product_data($pdo, $id, $data) {
    $sql = "UPDATE products SET sku=?, name=?, image=?, category_id=?, unit=?, price_import=?, status=?, updated_at=NOW() WHERE id=?";
    return db_execute($pdo, $sql, [
        $data['sku'], $data['name'], $data['image'], 
        $data['category_id'], $data['unit'], $data['price_import'], $data['status'], $id
    ]);
}

// 1. Hàm đếm tổng số sản phẩm sau khi lọc để tính tổng số trang
// Hàm đếm để phân trang
function count_products($pdo, $keyword = '', $cat_id = '') {
    $sql = "SELECT COUNT(*) FROM products WHERE deleted_at IS NULL";
    $params = [];
    if ($keyword) {
        $sql .= " AND (name LIKE ? OR sku LIKE ?)";
        $params[] = "%$keyword%"; $params[] = "%$keyword%";
    }
    if ($cat_id && $cat_id != '0') {
        $sql .= " AND category_id = ?";
        $params[] = $cat_id;
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

// 2. Hàm lấy sản phẩm theo trang
function get_products_paginated($pdo, $keyword, $cat_id, $limit, $offset) {
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.deleted_at IS NULL";
    $params = [];
    if ($keyword) {
        $sql .= " AND (p.name LIKE ? OR p.sku LIKE ?)";
        $params[] = "%$keyword%"; $params[] = "%$keyword%";
    }
    if ($cat_id && $cat_id != '0') {
        $sql .= " AND p.category_id = ?";
        $params[] = $cat_id;
    }
    $sql .= " ORDER BY p.id DESC LIMIT $limit OFFSET $offset";
    return db_get_all($pdo, $sql, $params);
}