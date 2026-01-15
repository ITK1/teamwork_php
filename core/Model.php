<?php
// Lấy nhiều dòng (Dùng cho List)

// core/Model.php

function db_get_all($pdo, $sql, $params = []) {
    if (!$pdo) {
        die("❌ Lỗi: Kết nối Database (\$pdo) bị NULL tại db_get_all");
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function db_execute($pdo, $sql, $params = []) {
    if (!$pdo) {
        die("❌ Lỗi: Kết nối Database (\$pdo) bị NULL tại db_execute");
    }
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

// Lấy 1 dòng (Dùng cho Edit/Detail)
function db_get_one($pdo, $sql, $params = []) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}

// Thực thi Insert, Update, Delete


// Xóa mềm (Soft Delete)
function db_soft_delete($pdo, $table, $id) {
    $sql = "UPDATE $table SET deleted_at = NOW() WHERE id = ?";
    return db_execute($pdo, $sql, [$id]);
}