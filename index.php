<?php
require_once 'config/config.php';
require_once 'core/Model.php';

// Module & action mặc định
$module = isset($_GET['module']) ? $_GET['module'] : 'common';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Đường dẫn controller
$controllerPath = "modules/$module/controller.php";

// Kiểm tra module tồn tại
if (!file_exists($controllerPath)) {
    die("❌ Module không tồn tại");
}

// Load controller
require_once $controllerPath;

// Tên hàm action (vd: homeAction, listAction)
$function = $action . 'Action';

// Kiểm tra action tồn tại
if (!function_exists($function)) {
    die("❌ Action không tồn tại");
}

$module = isset($_GET['module']) ? $_GET['module'] : 'dashboard';

if ($module == 'auth') {
    // Gọi controller của auth
    include 'modules/auth/controller.php';
} else {
    // Đây là trang Dashboard (Sau khi đăng nhập)
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?module=auth&action=login");
        exit;
    }
    
    echo "<h1>Xin chào, " . $_SESSION['username'] . "</h1>";
    echo "<a href='?module=auth&action=logout'>Đăng xuất</a>";
}
// Gọi action
$function();
if ($module == 'auth') {
    include 'modules/auth/controller.php';
} elseif ($module == 'category') {
    include 'modules/category/controller.php';
} else {
    // Dashboard chính
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?module=auth&action=login");
        exit;
    }
    
    // Giao diện Dashboard đơn giản có menu
    echo "<h1>Dashboard</h1>";
    echo "<p>Xin chào, <b>" . $_SESSION['username'] . "</b></p>";
    echo "<ul>";
    echo "<li><a href='?module=category&action=list'>Quản lý Danh Mục</a></li>";
    echo "<li><a href='?module=auth&action=logout'>Đăng xuất</a></li>";
    echo "</ul>";
}
if ($module == 'user') {
    include 'modules/user/controller.php';
}

else if ($module == 'user') {
    include 'modules/user/controller.php';
} 
else if($module == 'product') { // <--- THÊM ĐOẠN NÀY VÀO
    include 'modules/product/controller.php';
}

?>