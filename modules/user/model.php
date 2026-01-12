<?php
// modules/user/model.php

// Lấy danh sách tất cả user
function get_all_users($conn) {
    $stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy thông tin 1 user theo ID
function get_user_by_id($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Cập nhật thông tin user
// Nếu password được nhập mới thì cập nhật, không thì giữ nguyên
function update_user($conn, $id, $username, $email, $password = null) {
    if (!empty($password)) {
        // Có đổi mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username, 
            ':email' => $email, 
            ':password' => $hashed_password, 
            ':id' => $id
        ]);
    } else {
        // Không đổi mật khẩu
        $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username, 
            ':email' => $email, 
            ':id' => $id
        ]);
    }
}

// Xóa user
function delete_user($conn, $id) {
    // Không cho phép tự xóa chính mình (để an toàn)
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
        return false; 
    }
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

// Thêm user mới (nếu muốn thêm nhanh từ admin)
function add_user($conn, $username, $email, $password) {
    // Check email tồn tại
    $check = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $check->execute([':email' => $email]);
    if ($check->rowCount() > 0) return false;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashed_password
    ]);
}
?>