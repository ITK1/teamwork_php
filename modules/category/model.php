<?php
// modules/category/model.php

// Lấy tất cả danh mục
function get_all_categories($conn) {
    $stmt = $conn->prepare("SELECT * FROM categories ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy 1 danh mục theo ID
function get_category_by_id($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Thêm danh mục mới
function add_category($conn, $name) {
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");
    return $stmt->execute([':name' => $name]);
}

// Cập nhật danh mục
function update_category($conn, $id, $name) {
    $stmt = $conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
    return $stmt->execute([':name' => $name, ':id' => $id]);
}

// Xóa danh mục
function delete_category($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}
?>