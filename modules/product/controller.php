<?php
// modules/product/controller.php
require_once "model.php";

// Hàm mặc định
function homeAction($pdo) {
    listAction($pdo);
}

// Liệt kê
function listAction($pdo) {
    $products = get_products($pdo);
    require_once "modules/product/views/list.php";
}

// Thêm mới
function addAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        insert_product($pdo, $_POST);
        header("Location: index.php?module=product&action=list");
        exit;
    }
    $categories = db_get_all($pdo, "SELECT * FROM categories WHERE status = 1");
    require_once "modules/product/views/update.php";
}

// Sửa
function updateAction($pdo) {
    $id = $_GET['id'] ?? null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        update_product_data($pdo, $id, $_POST);
        header("Location: index.php?module=product&action=list");
        exit;
    }
    $product = get_product_by_id($pdo, $id);
    $categories = db_get_all($pdo, "SELECT * FROM categories WHERE status = 1");
    require_once "modules/product/views/update.php";
}

// Xóa (Soft Delete)
function deleteAction($pdo) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        db_soft_delete($pdo, 'products', $id); // Hàm chung từ core/Model.php
    }
    header("Location: index.php?module=product&action=list");
    exit;
}