<?php
// Lấy danh sách nhiều dòng
function db_get_all($pdo, $sql, $params = []) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

// Lấy 1 dòng duy nhất
function db_get_one($pdo, $sql, $params = []) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}

// Thực thi Insert, Update, Delete
function db_execute($pdo, $sql, $params = []) {
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

// Xóa mềm (Soft Delete)
function db_soft_delete($pdo, $table, $id) {
    $sql = "UPDATE $table SET deleted_at = NOW() WHERE id = ?";
    return db_execute($pdo, $sql, [$id]);
}