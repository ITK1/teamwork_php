<?php
function get_categories ($pdo){
    $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY id DESC";
    return db_get_all($pdo, $sql);
}

function insert_categories( $pdo, $data){
    $sql = "INSERT INTO categories (name, status) VALUES (?, ?)";
    return db_execute($pdo, $sql, [$data['name'], $data['status']]);
}
?>