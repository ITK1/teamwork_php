<?php
require_once "layouts/sidebar.php";
require_once "layouts/header.php";
require_once "views/dashboard.php";
require_once "modules/admin/model.php";


function homeAction($pdo) {
    listAction($pdo);
}

function listAction($pdo) {
    $categories = get_categories($pdo);
    require_once "modules/admin/views/list.php";
}
echo loadCSS();
?>