<?php
// Lấy danh sách danh mục (Hỗ trợ hiển thị phân cấp)
function get_categories_tree($pdo) {
    $sql = "SELECT * FROM categories ORDER BY parent_id ASC, id DESC";
    return db_get_all($pdo, $sql);
}

// Thêm danh mục mới (Cha hoặc Con)
function insert_category($pdo, $data) {
    $sql = "INSERT INTO categories (name, parent_id, status) VALUES (?, ?, ?)";
    $parent_id = ($data['parent_id'] == 0) ? null : $data['parent_id'];
    return db_execute($pdo, $sql, [$data['name'], $parent_id, $data['status']]);
}

// Cập nhật thông tin danh mục
function update_category_data($pdo, $id, $data) {
    $sql = "UPDATE categories SET name = ?, parent_id = ?, status = ? WHERE id = ?";
    $parent_id = ($data['parent_id'] == 0) ? null : $data['parent_id'];
    return db_execute($pdo, $sql, [$data['name'], $parent_id, $data['status'], $id]);
}