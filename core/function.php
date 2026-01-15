<?php

function loadView($view, $data = []) {
    global $module;

    if (!empty($data)) {
        extract($data); // 👈 BIẾN $product ĐƯỢC TẠO Ở ĐÂY
    }

    require "modules/$module/views/$view.php";
}

?>