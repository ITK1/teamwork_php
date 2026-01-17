<?php
function get_products($pdo, $keyword = '', $cat_id = '') {
    $sql = "SELECT p.*, c.name as cat_name FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id WHERE p.deleted_at IS NULL";
    $params = [];
    if ($keyword) { $sql .= " AND (p.name LIKE ? OR p.sku LIKE ?)"; $params[] = "%$keyword%"; $params[] = "%$keyword%"; }
    if ($cat_id) { $sql .= " AND p.category_id = ?"; $params[] = $cat_id; }
    $sql .= " ORDER BY p.id DESC";
    return db_get_all($pdo, $sql, $params);
}

function insert_product($pdo, $data) {
    $sql = "INSERT INTO products (sku, name, category_id, unit, price_import, status) VALUES (?, ?, ?, ?, ?, ?)";
    return db_execute($pdo, $sql, array_values($data));
}

function get_product_by_id($pdo, $id) {
    $sql = "SELECT * FROM products WHERE id = ? AND deleted_at IS NULL";
    return db_get_one($pdo, $sql, [$id]);
}
function update_product($pdo, $id, $data) {
    $sql = "UPDATE products SET sku=?, name=?, image=?, category_id=?, unit=?, price_import=?, status=?, updated_at=NOW() WHERE id=?";
    $params = array_values($data);
    $params[] = $id; // Thêm ID vào cuối mảng tham số cho điều kiện WHERE
    return db_execute($pdo, $sql, $params);
}