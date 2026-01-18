<?php
// Lấy danh sách nhà cung cấp
function get_suppliers($pdo) {
    return db_get_all($pdo, "SELECT * FROM suppliers ORDER BY id DESC");
}

// Thêm mới nhà cung cấp
function insert_supplier($pdo, $data) {
    $sql = "INSERT INTO suppliers (name, phone, email, address, status) VALUES (?, ?, ?, ?, ?)";
    return db_execute($pdo, $sql, [
        $data['name'], $data['phone'], $data['email'], $data['address'], $data['status'] ?? 1
    ]);
}

// Cập nhật nhà cung cấp
function update_supplier_data($pdo, $id, $data) {
    $sql = "UPDATE suppliers SET name=?, phone=?, email=?, address=?, status=? WHERE id=?";
    return db_execute($pdo, $sql, [
        $data['name'], $data['phone'], $data['email'], $data['address'], $data['status'], $id
    ]);
}