<?php

function get_products($sql) {
    $sql = "
    SELECT p.*, c.name AS category_name
    FROM product p
    LEFT JOIN category c ON p.category_id = c.category
    WHERE p.deleted_at IS NULL
    ORDER BY p.id DESC
    ";
    return getALL($sql);
}

function getOne_product($sql, $id) {
    $sql = "SELECT * FROM products WHERE id = ?";
    return getOne($sql);
}



?>