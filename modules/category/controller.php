<?php
require_once "modules/category/model.php";

layout('sidebar');
layout('header');
layout('home');
layout('footer');
url_css();
function homeAction($pdo) { listAction($pdo); }

function listAction($pdo) {
    $categories = get_categories_tree($pdo);
    require_once "modules/category/views/list.php";
}

function addAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        insert_category($pdo, $_POST);
        header("Location: index.php?module=category&action=list");
        exit;
    }
}

function updateAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        update_category_data($pdo, $id, $_POST);
        header("Location: index.php?module=category&action=list");
        exit;
    }
}