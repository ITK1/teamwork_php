<?php
require_once 'config/config.php';

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

// Gọi action
$function();
