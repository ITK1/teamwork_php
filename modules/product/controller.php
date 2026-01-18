<?php
require_once "modules/product/model.php";

layout('sidebar');
layout('header');
layout('home');
layout('footer');
url_css();

function homeAction($pdo) {
    listAction($pdo);
    
}
function listAction($pdo) {
    // 1. Lấy từ khóa lọc từ URL
    $keyword = $_GET['search'] ?? '';
    $cat_id = $_GET['category_id'] ?? '';
    
    // 2. Cấu hình phân trang
    $limit = 10; // Số sản phẩm mỗi trang
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;

    // 3. Lấy tổng số bản ghi để tính số trang
    $total_records = count_products($pdo, $keyword, $cat_id); // Hàm này phải có trong Model
    $total_pages = ceil($total_records / $limit);

    // 4. Lấy dữ liệu sản phẩm theo giới hạn LIMIT OFFSET
    $products = get_products_paginated($pdo, $keyword, $cat_id, $limit, $offset);
    
    // 5. Lấy danh mục cho ô Select lọc
    $categories = db_get_all($pdo, "SELECT * FROM categories WHERE status = 1");
    
    // Nạp View
    require_once "modules/product/views/list.php";
}

function addAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $img = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $img = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $img);
        }
        $data = [
            'sku' => $_POST['sku'], 'name' => $_POST['name'], 'image' => $img,
            'category_id' => $_POST['category_id'], 'unit' => $_POST['unit'],
            'price_import' => $_POST['price_import'] ?? 0, 'status' => $_POST['status'] ?? 1
        ];
        insert_product($pdo, $data);
        header("Location: index.php?module=product&action=list");
        exit;
    }
}

function updateAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $product = db_get_one($pdo, "SELECT image FROM products WHERE id = ?", [$id]);
        $img = $product['image'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $newImg = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $newImg);
            if ($img && file_exists("uploads/products/".$img)) unlink("uploads/products/".$img);
            $img = $newImg;
        }

        $data = [
            'sku' => $_POST['sku'], 'name' => $_POST['name'], 'image' => $img,
            'category_id' => $_POST['category_id'], 'unit' => $_POST['unit'],
            'price_import' => $_POST['price_import'] ?? 0, 'status' => $_POST['status'] ?? 1
        ];
        update_product_data($pdo, $id, $data);
        header("Location: index.php?module=product&action=list");
        exit;
    }
}

function deleteAction($pdo) {
    $id = $_GET['id'] ?? null;
    if ($id) db_soft_delete($pdo, 'products', $id);
    header("Location: index.php?module=product&action=list");
    exit;
}



