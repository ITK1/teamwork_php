<!DOCTYPE html>
<html>

<head>
    <title>Quản lý User</title>
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
    <h2>Danh sách Thành viên</h2>
    <a href="index.php">Về Dashboard</a>

    <div style="margin: 20px 0; padding: 15px; background: #eee; border: 1px solid #ccc;">
        <strong>Thêm thành viên mới:</strong>
        <form method="POST" action="" style="margin-top: 10px;">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="btn_add_user">Thêm</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?php echo $u['id']; ?></td>
                <td><?php echo htmlspecialchars($u['username']); ?></td>
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td>
                    <a href="?module=user&action=update&id=<?php echo $u['id']; ?>">Sửa</a> |
                    <a href="?module=user&action=delete&id=<?php echo $u['id']; ?>" style="color:red;">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>