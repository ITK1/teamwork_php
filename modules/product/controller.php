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
    $keyword = $_GET['search'] ?? '';
    $cat_id = $_GET['category_id'] ?? '';
    $products = get_products($pdo, $keyword, $cat_id);
    $categories = db_get_all($pdo, "SELECT * FROM categories WHERE status = 1");
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
            $_POST['sku'], $_POST['name'], $img, $_POST['category_id'], 
            $_POST['unit'], $_POST['price_import'], $_POST['status']
        ];
        insert_product($pdo, $data);
        header("Location: index.php?module=product&action=list");
        exit;
    }
    $categories = db_get_all($pdo, "SELECT * FROM categories WHERE status = 1");
    require_once "modules/product/views/update.php";
}

function updateAction($pdo) {
    $id = $_GET['id'] ?? null;
    $product = get_product_by_id($pdo, $id);
    if (!$product) die("Không tìm thấy sản phẩm!");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $img = $product['image']; // Mặc định giữ lại tên ảnh cũ

        // Nếu người dùng upload ảnh mới
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $newImg = time() . '_' . $_FILES['image']['name'];
            if (move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $newImg)) {
                // Xóa ảnh cũ khỏi thư mục để tiết kiệm bộ nhớ
                if ($img && file_exists("uploads/products/" . $img)) {
                    unlink("uploads/products/" . $img);
                }
                $img = $newImg;
            }
        }

        $data = [
            'sku' => $_POST['sku'],
            'name' => $_POST['name'],
            'image' => $img,
            'category_id' => $_POST['category_id'],
            'unit' => $_POST['unit'],
            'price_import' => $_POST['price_import'],
            'status' => $_POST['status']
        ];

        update_product($pdo, $id, $data);
        header("Location: index.php?module=product&action=list");
        exit;
    }

    $categories = db_get_all($pdo, "SELECT * FROM categories WHERE status = 1");
    require_once "modules/product/views/update.php"; // Dùng chung form với Add
}

function deleteAction($pdo) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        // Sử dụng xóa mềm (Soft Delete) để giữ lại lịch sử kho
        db_soft_delete($pdo, 'products', $id);
    }
    header("Location: index.php?module=product&action=list");
    exit;
}



