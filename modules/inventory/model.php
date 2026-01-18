<?php
// Lưu phiếu nhập và tự động cộng tồn kho
function create_import_transaction($pdo, $data) {
    try {
        $pdo->beginTransaction();

        // Tạm thời gán ID = 1 vì bạn chưa có module User
        $userId = $_SESSION['user_id'] ?? 1;

        // 1. Thêm bản ghi vào bảng lịch sử giao dịch
        $sql = "INSERT INTO inventory_transactions (product_id, supplier_id, type, source, quantity, price, note, created_by) 
                VALUES (?, ?, 'IN', 'purchase', ?, ?, ?, ?)";
        
        db_execute($pdo, $sql, [
            $data['product_id'], 
            $data['supplier_id'], 
            $data['quantity'], 
            $data['price'], 
            $data['note'], 
            $userId
        ]);

        // 2. Cập nhật cộng dồn vào trường quantity ở bảng products
        $sqlUpdate = "UPDATE products SET quantity = quantity + ? WHERE id = ?";
        db_execute($pdo, $sqlUpdate, [$data['quantity'], $data['product_id']]);

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}