<?php
require_once "modules/supplier/model.php";

layout('sidebar');
layout('header');
layout('home');
layout('footer');
url_css();

function homeAction($pdo) {
    listAction($pdo);
}
function listAction($pdo) {
    $suppliers = get_suppliers($pdo);
    require_once "modules/supplier/views/list.php";
}

function addAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        insert_supplier($pdo, $_POST);
        header("Location: index.php?module=supplier&action=list");
        exit;
    }
}

function updateAction($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        update_supplier_data($pdo, $_POST['id'], $_POST);
        header("Location: index.php?module=supplier&action=list");
        exit;
    }
}