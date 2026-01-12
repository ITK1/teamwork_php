<!DOCTYPE html>
<html>

<head>
    <title>Quản lý danh mục</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <h2>Quản lý Danh Mục</h2>
    <a href="index.php">Create Dashboard</a>

    <div style="margin: 20px 0; padding: 10px; border: 1px solid #ccc; background: #f9f9f9;">
        <strong>Thêm danh mục mới:</strong>
        <form method="POST" action="?module=category&action=list" style="display:inline-block;">
            <input type="text" name="name" placeholder="Tên danh mục..." required>
            <button type="submit" name="btn_add">Thêm</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?php echo $cat['id']; ?></td>
                <td><?php echo htmlspecialchars($cat['name']); ?></td>
                <td>
                    <a href="?module=category&action=update&id=<?php echo $cat['id']; ?>">Sửa</a> |
                    <a href="?module=category&action=delete&id=<?php echo $cat['id']; ?>" style="color:red;">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>