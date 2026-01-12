<?php
require_once 'model.php';

switch ($action){
    case 'list':
        $product = get_products($sql);
        require_once "views/list.php";
}

?>
