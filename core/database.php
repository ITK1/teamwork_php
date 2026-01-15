<?php
// config/db.php hoặc core/database.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ql_khohang";

try {
    // Phải đặt tên biến là $pdo để khớp với file index.php và controller
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    
    // Thiết lập chế độ báo lỗi và kiểu dữ liệu trả về mặc định
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi kết nối PDO: " . $e->getMessage());
}