<?php
// modules/auth/model.php

// Hàm đăng ký
function auth_register($conn, $username, $email, $password) {
    // Kiểm tra email tồn tại
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    if ($stmt->rowCount() > 0) {
        return false; // Email đã tồn tại
    }

    // Thêm mới
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashed_password
    ]);
}

// Hàm lấy thông tin user để đăng nhập
function auth_get_user_by_email($conn, $email) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>