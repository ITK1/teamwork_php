<?php
require_once "layouts/sidebar.php";
require_once "layouts/header.php";
require_once "views/dashboard.php";


switch ($module){
    case "product":
        require_once "./modules/product/controller.php";
}

?>