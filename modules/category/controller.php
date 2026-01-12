<?php
// modules/category/controller.php
require_once 'model.php';

// Kiểm tra đăng nhập (Bắt buộc phải đăng nhập mới được quản lý danh mục)
if (!isset($_SESSION['user_id'])) {
    header("Location: ?module=auth&action=login");
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        // Xử lý thêm nhanh ngay tại trang list (nếu muốn) hoặc chỉ hiện danh sách
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_add'])) {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                add_category($conn, $name);
                header("Location: ?module=category&action=list"); // Refresh để thấy mới
                exit;
            }
        }
        
        $categories = get_all_categories($conn);
        include 'views/list.php';
        break;

    case 'update':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $category = get_category_by_id($conn, $id);

        if (!$category) {
            die("Danh mục không tồn tại!");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                update_category($conn, $id, $name);
                header("Location: ?module=category&action=list");
                exit;
            }
        }
        include 'views/update.php';
        break;

    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        // Nếu người dùng xác nhận xóa (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            delete_category($conn, $id);
            header("Location: ?module=category&action=list");
            exit;
        }
        
        // Nếu chưa xác nhận, hiển thị trang hỏi (View Delete)
        $category = get_category_by_id($conn, $id);
        include 'views/delete.php';
        break;
}
?>