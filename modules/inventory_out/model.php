<?php
// Lưu phiếu xuất và tự động trừ tồn kho
function create_export_transaction($pdo, $data) {
    try {
        $pdo->beginTransaction();

        // 1. Kiểm tra tồn kho hiện tại trước khi xuất
        $product = db_get_one($pdo, "SELECT quantity FROM products WHERE id = ?", [$data['product_id']]);
        if ($product['quantity'] < $data['quantity']) {
            throw new Exception("Số lượng xuất vượt quá tồn kho hiện tại!");
        }

        $userId = $_SESSION['user_id'] ?? 1;

        // 2. Thêm bản ghi vào bảng lịch sử giao dịch (loại 'OUT')
        $sql = "INSERT INTO inventory_transactions (product_id, type, source, quantity, price, note, created_by) 
                VALUES (?, 'OUT', 'sale', ?, ?, ?, ?)";
        
        db_execute($pdo, $sql, [
            $data['product_id'], 
            $data['quantity'], 
            $data['price'], // Giá bán/xuất
            $data['note'], 
            $userId
        ]);

        // 3. Cập nhật trừ vào trường quantity ở bảng products
        $sqlUpdate = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
        db_execute($pdo, $sqlUpdate, [$data['quantity'], $data['product_id']]);

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_msg'] = $e->getMessage();
        return false;
    }
}