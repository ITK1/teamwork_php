<?php
// modules/auth/controller.php
require_once 'model.php'; // Gọi thư viện hàm

$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$error = '';
$success = '';

switch ($action) {
    case 'register':
        // Xử lý khi bấm nút Đăng ký
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (auth_register($conn, $username, $email, $password)) {
                $success = "Đăng ký thành công! Hãy đăng nhập.";
            } else {
                $error = "Email đã tồn tại hoặc lỗi hệ thống.";
            }
        }
        include 'views/register.php';
        break;

    case 'login':
        // Xử lý khi bấm nút Đăng nhập
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = auth_get_user_by_email($conn, $email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php"); // Về trang chủ
                exit;
            } else {
                $error = "Sai email hoặc mật khẩu.";
            }
        }
        include 'views/login.php';
        break;

    case 'logout':
        session_destroy();
        unset($_SESSION['user_id']);
        include 'views/logout.php';
        break;
}
?>