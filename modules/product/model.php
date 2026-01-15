<?php
// modules/product/model.php

// Lấy danh sách sản phẩm
function get_products($pdo) {
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.deleted_at IS NULL 
            ORDER BY p.id DESC";
    return db_get_all($pdo, $sql);
}

// Lấy 1 sản phẩm
function get_product_by_id($pdo, $id) {
    $sql = "SELECT * FROM products WHERE id = ?";
    return db_get_one($pdo, $sql, [$id]);
}

// Thêm mới sản phẩm
function insert_product($pdo, $data) {
    $sql = "INSERT INTO products (sku, name, category_id, unit, price_import, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    return db_execute($pdo, $sql, [
        $data['sku'], $data['name'], $data['category_id'], 
        $data['unit'], $data['price_import'], $data['status']
    ]);
}

// Cập nhật sản phẩm
function update_product_data($pdo, $id, $data) {
    $sql = "UPDATE products SET sku = ?, name = ?, category_id = ?, unit = ?, 
            price_import = ?, status = ?, updated_at = NOW() 
            WHERE id = ?";
    return db_execute($pdo, $sql, [
        $data['sku'], $data['name'], $data['category_id'], 
        $data['unit'], $data['price_import'], $data['status'], $id
    ]);
}