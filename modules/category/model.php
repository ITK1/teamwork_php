<?php
function get_categories_tree($pdo) {
    return db_get_all($pdo, "SELECT * FROM categories ORDER BY parent_id ASC, id DESC");
}

function insert_category($pdo, $data) {
    $parent_id = ($data['parent_id'] == 0) ? null : $data['parent_id'];
    return db_execute($pdo, "INSERT INTO categories (name, parent_id, status) VALUES (?, ?, ?)", 
        [$data['name'], $parent_id, $data['status']]);
}

function update_category_data($pdo, $id, $data) {
    $parent_id = ($data['parent_id'] == 0) ? null : $data['parent_id'];
    return db_execute($pdo, "UPDATE categories SET name = ?, parent_id = ?, status = ? WHERE id = ?", 
        [$data['name'], $parent_id, $data['status'], $id]);
}