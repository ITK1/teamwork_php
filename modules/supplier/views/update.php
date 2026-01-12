<!DOCTYPE html>
<html>

<head>
    <title>Sửa danh mục</title>
</head>

<body>
    <h2>Cập nhật danh mục</h2>

    <form method="POST" action="">
        <label>Tên danh mục:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required><br><br>

        <button type="submit">Lưu cập nhật</button>
        <a href="?module=category&action=list">Hủy</a>
    </form>
</body>

</html>