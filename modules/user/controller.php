<?php
// modules/user/controller.php
require_once 'model.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ?module=auth&action=login");
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        // Xử lý thêm user mới ngay tại trang list (nếu cần)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_add_user'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            add_user($conn, $username, $email, $password);
            header("Location: ?module=user&action=list");
            exit;
        }

        $users = get_all_users($conn);
        include 'views/list.php';
        break;

    case 'update':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $user = get_user_by_id($conn, $id);

        if (!$user) die("Người dùng không tồn tại");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Có thể rỗng nếu ko đổi pass

            update_user($conn, $id, $username, $email, $password);
            header("Location: ?module=user&action=list");
            exit;
        }
        include 'views/update.php';
        break;

    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (delete_user($conn, $id)) {
                header("Location: ?module=user&action=list");
            } else {
                echo "<script>alert('Không thể xóa chính mình!'); window.location.href='?module=user&action=list';</script>";
            }
            exit;
        }
        
        $user = get_user_by_id($conn, $id);
        include 'views/delete.php';
        break;
}
?>